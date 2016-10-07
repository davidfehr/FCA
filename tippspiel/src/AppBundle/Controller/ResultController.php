<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ResultController extends Controller {

    /**
     * @Route("/updateRanking", name="updateRanking")
     */
    public function updateRankingAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        
        $userRepo = $this->getDoctrine()->getRepository('AppBundle:User');
        $users = $userRepo->getAllPlayer();  
        
        $usersArray = array();
        foreach($users as $user) {
            $userInfo = array();
            $userInfo[0] = $user;
            $userInfo[1] = 0;
            $usersArray[$user->getId()] = $userInfo;
        }        
        
        $questionRepo = $this->getDoctrine()->getRepository('AppBundle:Question');
        $questions = $questionRepo->getFinishedQuestions();
        $answerRepo = $this->getDoctrine()->getRepository('AppBundle:Answer');
        $answers = $answerRepo->findByQuestions($questions);
        
        foreach($answers as $answer) {
            if(!isset($usersArray[$answer->getUser()->getId()])) {
                continue;
            }            
            $currentUserPoints = $usersArray[$answer->getUser()->getId()][1];            
            
            if($answer->getQuestion()->getCorrectAnswer() == $answer->getAnswer()) {
                if($answer->getQuestion()->getType()->getName() == 'OPEN_QUESTION') {
                    $currentUserPoints = $currentUserPoints + 5; //EU-Champion, goalgetter, etc
                } elseif($answer->getQuestion()->getType()->getName() == 'SELECTION') {
                    $currentUserPoints = $currentUserPoints + 5; //Coach
                } elseif($answer->getQuestion()->getType()->getName() == 'SELECTION_TEAM_KREISLIGA') {
                    $currentUserPoints = $currentUserPoints + 10; //Champion Kreisliga
                } elseif($answer->getQuestion()->getType()->getName() == 'SELECTION_TEAM_AKLASSE') {                    
                    $currentUserPoints = $currentUserPoints + 10; //Champion Kreisliga
                } elseif($answer->getQuestion()->getType()->getName() == 'SELECTION_COUNT') {                     
                    $currentUserPoints = $currentUserPoints + 5; //Platzierung Aich
                } elseif($answer->getQuestion()->getType()->getName() == 'SELECTION_TEAM_BULI' ||
                        $answer->getQuestion()->getType()->getName() == 'SELECTION_TEAM_BULI2') {                     
                    $currentUserPoints = $currentUserPoints + 6; //Platzierung Buli
                } elseif($answer->getQuestion()->getType()->getName() == 'SELECTION_ROUND') {                     
                    $currentUserPoints = $currentUserPoints + 5; //Platzierung Buli
                } 
            } else {
                if($answer->getQuestion()->getType()->getName() == 'SELECTION_COUNT') {                     
                    // -1
                } elseif($answer->getQuestion()->getType()->getName() == 'SELECTION_TEAM_BULI' ||
                        $answer->getQuestion()->getType()->getName() == 'SELECTION_TEAM_BULI2') {                     
                    // +3 for correct club
                } elseif($answer->getQuestion()->getType()->getName() == 'SELECTION_ROUND') {                     
                    // -2
                }
            }
            $usersArray[$answer->getUser()->getId()][1] = $currentUserPoints;
        }        
        
        $gameRepo = $this->getDoctrine()->getRepository('AppBundle:Game');
        $games = $gameRepo->getFinishedGames();        
        $betRepo = $this->getDoctrine()->getRepository('AppBundle:Bet');
        $bets = $betRepo->findByGames($games);
        
        foreach($bets as $bet) {
            if(!isset($usersArray[$bet->getUser()->getId()])) {
                continue;
            }            
            
            $currentUserPoints = $usersArray[$bet->getUser()->getId()][1];
            
            if($bet->getHomeTeamScore() == $bet->getGame()->getHomeTeamScore() && $bet->getGuestTeamScore() == $bet->getGame()->getGuestTeamScore()) {
                $user = $bet->getUser();
                
                $currentUserPoints = $currentUserPoints + 5;
            } else if ($bet->getHomeTeamScore() == $bet->getGuestTeamScore() && $bet->getGame()->getHomeTeamScore() == $bet->getGame()->getGuestTeamScore()) {
                $currentUserPoints = $currentUserPoints + 2;
            } else if ($bet->getHomeTeamScore() > $bet->getGuestTeamScore() && $bet->getGame()->getHomeTeamScore() > $bet->getGame()->getGuestTeamScore()) {
                $currentUserPoints = $currentUserPoints + 2;
            } else if ($bet->getHomeTeamScore() < $bet->getGuestTeamScore() && $bet->getGame()->getHomeTeamScore() < $bet->getGame()->getGuestTeamScore()) {
                $currentUserPoints = $currentUserPoints + 2;
            }
            $usersArray[$bet->getUser()->getId()][1] = $currentUserPoints;
        }  
        
        foreach($usersArray as $singleArray) {
            $singleArray[0]->setPoints($singleArray[1]);
            $em->persist($singleArray[0]);
        }
        
        $em->flush(); 
        return $this->redirectToRoute('ranking');
    }
    
    /**
     * @Route("/ranking", name="ranking")
     */
    public function rankingAction(Request $request) {
        $userRepo = $this->getDoctrine()->getRepository('AppBundle:User');
        $users = $userRepo->getAllPlayer();
        
        return $this->render('result/ranking.html.twig', array(
            'users' => $users
        ));
    }

    /**
     * @Route("/allGames", name="allGames")
     */
    public function allGamesAction(Request $request) {
        $gameRepo = $this->getDoctrine()->getRepository('AppBundle:Game');
        $games = $gameRepo->findAll();        
        return $this->render('result/allGames.html.twig', array(
                    'games' => $games
        ));
    }

    /**
     * @Route("/allQuestions", name="allQuestions")
     */
    public function allQuestionsAction(Request $request) {
        $questionRepo = $this->getDoctrine()->getRepository('AppBundle:Question');
        $questions = $questionRepo->findAll();
        return $this->render('result/allQuestions.html.twig', array(
                    'questions' => $questions
        ));
    }

    /**
     * @Route("/search", name="search")
     */
    public function searchAction(Request $request) {

        $search = $request->query->get('search');

        $usersRepo = $this->getDoctrine()->getRepository('AppBundle:User');
        $users = $usersRepo->searchForName($search);

        return $this->render('result/userSearch.html.twig', array(
                    'users' => $users
        ));
    }

    /**
     * AJAX
     * 
     * @Route("/detail", name="detail")
     */
    public function detailAction(Request $request) {
        $name = $request->query->get('name');

        $usersRepo = $this->getDoctrine()->getRepository('AppBundle:User');
        $user = $usersRepo->findOneBy(array('name' => $name, 'complete' => 1));

        $answerRepository = $this->getDoctrine()->getRepository('AppBundle:Answer');
        $answers = $answerRepository->findBy(array('user' => $user));

        $betRepository = $this->getDoctrine()->getRepository('AppBundle:Bet');
        $bets = $betRepository->findBy(array('user' => $user));

        return $this->render('result/detail.html.twig', array(
                    'user' => $user,
                    'answers' => $answers,
                    'bets' => $bets
        ));
    }

    /**
     * @Route("/info", name="info")
     */
    public function infoAction(Request $request) {
        return $this->render('result/info.html.twig', array(
        ));
    }

    /**
     * @Route("/userDetail/{userId}", name="userDetail")
     */
    public function userDetailAction($userId, Request $request) {

        $usersRepo = $this->getDoctrine()->getRepository('AppBundle:User');
        $user = $usersRepo->findOneBy(array('id' => $userId, 'complete' => 1));

        $answerRepository = $this->getDoctrine()->getRepository('AppBundle:Answer');
        $answers = $answerRepository->findBy(array('user' => $user));

        $betRepository = $this->getDoctrine()->getRepository('AppBundle:Bet');
        $bets = $betRepository->findBy(array('user' => $user));

        return $this->render('result/userDetail.html.twig', array(
                    'user' => $user,
                    'answers' => $answers,
                    'bets' => $bets
        ));
    }

    /**
     * @Route("/gameDetail/{gameId}", name="gameDetail")
     */
    public function gameDetailAction($gameId, Request $request) {

        $gameRepo = $this->getDoctrine()->getRepository('AppBundle:Game');
        $game = $gameRepo->findOneBy(array('id' => $gameId));

        $betRepo = $this->getDoctrine()->getRepository('AppBundle:Bet');
        $bets = $betRepo->findBy(array('game' => $game));

        return $this->render('result/gameDetail.html.twig', array(
                    'game' => $game,
                    'bets' => $bets
        ));
    }

    /**
     * @Route("/questionDetail/{questionId}", name="questionDetail")
     */
    public function questionDetailAction($questionId, Request $request) {

        $questionRepo = $this->getDoctrine()->getRepository('AppBundle:Question');
        $question = $questionRepo->findOneBy(array('id' => $questionId));

        $answerRepo = $this->getDoctrine()->getRepository('AppBundle:Answer');
        $answers = $answerRepo->findBy(array('question' => $question));

        return $this->render('result/questionDetail.html.twig', array(
                    'question' => $question,
                    'answers' => $answers
        ));
    }

}
