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
        
        $typeRepo = $this->getDoctrine()->getRepository('AppBundle:QuestionType');
        $roundRepo = $this->getDoctrine()->getRepository('AppBundle:Round');
        foreach($answers as $answer) {
            if(!isset($usersArray[$answer->getUser()->getId()])) {
                continue;
            }            
            $currentUserPoints = $usersArray[$answer->getUser()->getId()][1];            
            
            //IF ANSWER CORRECT
            if($answer->getQuestion()->getCorrectAnswer() == $answer->getAnswer()) {
                if($answer->getQuestion()->getType()->getName() == 'OPEN_QUESTION') {
                    
                    //TODO Points for Pokalsieger wrong
                    if($answer->getQuestion()->getId() == 1) { //Pokalsieger
                        if($answer->getAnswer() == 'Borussia Dortmund') {
                            $currentUserPoints = $currentUserPoints + 10;
                        } else if($answer->getAnswer() == 'Eintracht Frankfurt') {
                            $currentUserPoints = $currentUserPoints + 5;
                        } else if(in_array($answer->getAnswer(), array('Bayern München', 'Gladbach'))) {
                            $currentUserPoints = $currentUserPoints + 2;
                        }
                        
                    } elseif($answer->getQuestion()->getId() == 2) { //Championsleague
                        if($answer->getAnswer() == 'Real Madrid') {
                            $currentUserPoints = $currentUserPoints + 10;
                        } else if($answer->getAnswer() == 'Juventus Turin') {
                            $currentUserPoints = $currentUserPoints + 5;
                        } else if(in_array($answer->getAnswer(), array('AS Monaco', 'Atletico Madrid'))) {
                            $currentUserPoints = $currentUserPoints + 2;
                        }                        
                    } elseif(in_array($answer->getQuestion()->getId(), array(3, 18, 22))) { //Championsleague
                        $currentUserPoints = $currentUserPoints + 10;
                    } else {
                        $currentUserPoints = $currentUserPoints + 5; //EU-Champion, goalgetter, etc
                    }
                    
                    
                } elseif($answer->getQuestion()->getType()->getName() == 'SELECTION') {
                    $currentUserPoints = $currentUserPoints + 5; //Coach
                } elseif($answer->getQuestion()->getType()->getName() == 'SELECTION_TEAM_KREISLIGA') {
                    $currentUserPoints = $currentUserPoints + 10; //Champion Kreisliga
                } elseif($answer->getQuestion()->getType()->getName() == 'SELECTION_TEAM_AKLASSE') {                    
                    $currentUserPoints = $currentUserPoints + 10; //Champion Kreisliga
                } elseif($answer->getQuestion()->getType()->getName() == 'SELECTION_COUNT') {                     
                    $currentUserPoints = $currentUserPoints + 5; //Platzierung Aich
                } elseif($answer->getQuestion()->getType()->getName() == 'PLACEMENT_BULI' ||
                    $answer->getQuestion()->getType()->getName() == 'PLACEMENT_BULI2') {                     
                    $currentUserPoints = $currentUserPoints + 6; //Platzierung Buli
                } elseif($answer->getQuestion()->getType()->getName() == 'SELECTION_ROUND') {                     
                    $currentUserPoints = $currentUserPoints + 5; //Wie weit im Europapokal
                } 
            //IF ANSWER is FALSE
            } elseif($answer->getQuestion()->getCorrectAnswer() != null) {
                $correction = 0;
                if($answer->getQuestion()->getType()->getName() == 'SELECTION_COUNT') { //Platzierung                     
                    $correction = 5 - abs($answer->getQuestion()->getCorrectAnswer() - $answer->getAnswer());
                } elseif($answer->getQuestion()->getType()->getName() == 'PLACEMENT_BULI') {
                    $type = $typeRepo->findOneByName('PLACEMENT_BULI');
                    $questions = $questionRepo->getRankedTeams($type);
                    foreach($questions as $question) {
                        if($question->getCorrectAnswer() == $answer->getAnswer()) {    
                            $correction = 3;
                            break;
                        }
                    }
                } elseif($answer->getQuestion()->getType()->getName() == 'PLACEMENT_BULI2') {
                    $type = $typeRepo->findOneByName('PLACEMENT_BULI2');
                    $questions = $questionRepo->getRankedTeams($type);
                    foreach($questions as $question) {
                        if($question->getCorrectAnswer() == $answer->getAnswer() && (abs($question->getCorrectAnswer() - $answer->getAnswer()) < 6)) {    
                            $correction = 3;
                            break;
                        }
                    }                    
                } elseif($answer->getQuestion()->getType()->getName() == 'SELECTION_ROUND') {                     
                    $betRound = $roundRepo->findOneByName($answer->getAnswer());
                    $correctRound = $roundRepo->findOneByName($answer->getQuestion()->getCorrectAnswer());
                    $correction = (5 - (abs($betRound->getId() - $correctRound->getId())*2));
                }
                $currentUserPoints = $currentUserPoints + $correction;
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
            
            //Genau richtig
            if($bet->getHomeTeamScore() == $bet->getGame()->getHomeTeamScore() && $bet->getGuestTeamScore() == $bet->getGame()->getGuestTeamScore()) {
                $user = $bet->getUser();
                $currentUserPoints = $currentUserPoints + 5;
            //Tendenz Unentschieden
            } else if ($bet->getHomeTeamScore() == $bet->getGuestTeamScore() && $bet->getGame()->getHomeTeamScore() == $bet->getGame()->getGuestTeamScore()) {
                $currentUserPoints = $currentUserPoints + 2;
            //Tendenz Heimsieg    
            } else if ($bet->getHomeTeamScore() > $bet->getGuestTeamScore() && $bet->getGame()->getHomeTeamScore() > $bet->getGame()->getGuestTeamScore()) {
                $currentUserPoints = $currentUserPoints + 2;
            //Tendenz Auswärtssieg
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
        
        $ranking = array();
        
        $previousPlayer = null;
        $currentPlacement = 1;
        $nextPlacement = 1;
        foreach($users as $user) {
            if($previousPlayer == null) {
                $ranking[$currentPlacement] = array();
                array_push($ranking[$currentPlacement], $user);
            } else {
                if($user->getPoints() == $previousPlayer->getPoints()) {
                    array_push($ranking[$currentPlacement], $user);
                    
                } else {
                    $currentPlacement = $nextPlacement;
                    $ranking[$currentPlacement] = array();
                    array_push($ranking[$currentPlacement], $user);
                }
            }
            $nextPlacement++;
            $previousPlayer = $user;
        }
        
        
        return $this->render('result/ranking.html.twig', array(
            'users' => $users,
            'ranking' => $ranking
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
        
        
        $questionRepo = $this->getDoctrine()->getRepository('AppBundle:Question');
        $typeRepo = $this->getDoctrine()->getRepository('AppBundle:QuestionType');
        $teamsInSlot = array();
        
        $typeBuli1 = $typeRepo->findOneByName('PLACEMENT_BULI');
        $typeBuli2 = $typeRepo->findOneByName('PLACEMENT_BULI2');

        $questions = $questionRepo->getRankedTeams($typeBuli1);
        foreach($questions as $question) {
            array_push($teamsInSlot, $question->getCorrectAnswer());
        }
        $questions = $questionRepo->getRankedTeams($typeBuli2);
        foreach($questions as $question) {
            array_push($teamsInSlot, $question->getCorrectAnswer());
        }                     
        
        return $this->render('result/userDetail.html.twig', array(
                    'user' => $user,
                    'answers' => $answers,
                    'bets' => $bets,
                    'teamsInSlot' => $teamsInSlot
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

        if($request->query->get('table') == 'true') {
            return $this->render('result/gameDetailTable.html.twig', array(
                        'game' => $game,
                        'bets' => $bets
            ));            
            
        } else {
            return $this->render('result/gameDetail.html.twig', array(
                        'game' => $game,
                        'bets' => $bets
            ));
        }
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
