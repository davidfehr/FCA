<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ResultController extends Controller {


    
    /**
     * @Route("/ranking", name="ranking")
     */
    public function rankingAction(Request $request) {
        return $this->render('result/ranking.html.twig', array(
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
