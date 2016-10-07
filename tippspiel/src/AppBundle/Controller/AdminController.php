<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller {

    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction(Request $request) {
        return $this->render('admin/info.html.twig', array(
        ));
    }

    /**
     * @Route("/adminGames", name="adminGames")
     */
    public function adminGamesAction(Request $request) {
        $gameRepo = $this->getDoctrine()->getRepository('AppBundle:Game');
        $games = $gameRepo->findAll();
        return $this->render('admin/allGames.html.twig', array(
                    'games' => $games
        ));
    }

    /**
     * @Route("/adminQuestions", name="adminQuestions")
     */
    public function adminQuestionsAction(Request $request) {
        $questionRepo = $this->getDoctrine()->getRepository('AppBundle:Question');
        $questions = $questionRepo->findAll();
        return $this->render('admin/allQuestions.html.twig', array(
                    'questions' => $questions
        ));
    }

    /**
     * @Route("/adminGame/{gameId}", name="adminGame")
     */
    public function adminGameAction($gameId, Request $request) {
        $gameRepo = $this->getDoctrine()->getRepository('AppBundle:Game');
        $game = $gameRepo->findOneBy(array('id' => $gameId));
        return $this->render('admin/game.html.twig', array(
                    'game' => $game
        ));
    }

    /**
     * @Route("/adminQuestion/{questionId}", name="adminQuestion")
     */
    public function adminQuestionAction($questionId, Request $request) {
        $questionRepo = $this->getDoctrine()->getRepository('AppBundle:Question');
        $question = $questionRepo->findOneBy(array('id' => $questionId));

        $leagueRepo = $this->getDoctrine()->getRepository('AppBundle:League');
        $bundesliga = $leagueRepo->findOneBy(array('name' => '1.Bundesliga'));
        $bundesliga2 = $leagueRepo->findOneBy(array('name' => '2.Bundesliga'));
        $kreisliga = $leagueRepo->findOneBy(array('name' => 'Kreisliga I'));
        $aklasse = $leagueRepo->findOneBy(array('name' => 'A-Klasse I'));

        $teamRepo = $this->getDoctrine()->getRepository('AppBundle:Team');
        $buliTeams = $teamRepo->findBy(array('league' => $bundesliga));
        $buli2Teams = $teamRepo->findBy(array('league' => $bundesliga2));
        $kreisligaTeams = $teamRepo->findBy(array('league' => $kreisliga));
        $aklassenTeams = $teamRepo->findBy(array('league' => $aklasse));

        $roundRepo = $this->getDoctrine()->getRepository('AppBundle:Round');
        $rounds = $roundRepo->findAll();


        return $this->render('admin/question.html.twig', array(
                    'question' => $question,
                    'buliTeams' => $buliTeams,
                    'buli2Teams' => $buli2Teams,
                    'kreisligaTeams' => $kreisligaTeams,
                    'aklassenTeams' => $aklassenTeams,
                    'rounds' => $rounds
        ));
    }

    /**
     * @Route("/updateAdminGame", name="updateAdminGame")
     */
    public function updateAdminGameAction(Request $request) {
        $gameRepo = $this->getDoctrine()->getRepository('AppBundle:Game');

        $em = $this->getDoctrine()->getManager();

        $gameId = $request->get('gameId');
        $game = $gameRepo->findOneBy(array('id' => $gameId));

        $homeTeamScore = $request->get('homeTeamScore');
        $game->setHomeTeamScore($homeTeamScore);

        $guestTeamScore = $request->get('guestTeamScore');
        $game->setGuestTeamScore($guestTeamScore);

        $em->persist($game);
        $em->flush();

        return $this->render('admin/info.html.twig', array(
        ));
    }

    /**
     * @Route("/updateAdminQuestion", name="updateAdminQuestion")
     */
    public function updateAdminQuestionAction(Request $request) {
        $questionRepo = $this->getDoctrine()->getRepository('AppBundle:Question');

        $em = $this->getDoctrine()->getManager();

        $questionId = $request->get('questionId');
        $question = $questionRepo->findOneBy(array('id' => $questionId));

        $correctAnswer = $request->get('answer');
        $question->setCorrectAnswer($correctAnswer);

        $em->persist($question);
        $em->flush();

        return $this->render('admin/info.html.twig', array(
        ));
    }

}
