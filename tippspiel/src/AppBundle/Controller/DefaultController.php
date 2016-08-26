<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Answer;
use AppBundle\Entity\Bet;

class DefaultController extends Controller {

    /**
     * @Route("/user")
     */
    public function userAction(Request $request) {
        $post = Request::createFromGlobals();

        if ($post->request->has('submit')) {
            $name = $post->request->get('name');
            $email = $post->request->get('email');

            $em = $this->getDoctrine()->getManager();

            $user = new User();
            $user->setName($name);
            $user->setEmail($email);
            $em->persist($user);
            $em->flush();

            $session = $request->getSession();
            $session->set('userName', $name);
            $session->set('userId', $user->getId());

            $initalQuestionIndex = $post->request->get('questionInitalIndex');
            $questionCount = $post->request->get('questionCount');

            for ($initalQuestionIndex; $initalQuestionIndex <= $questionCount; $initalQuestionIndex++) {
                $answerText = $post->request->get('answer' . $initalQuestionIndex);
                $questionId = $post->request->get('questionId' . $initalQuestionIndex);

                $answer = new Answer();
                $answer->setAnswer($answerText);
                $answer->setQuestionId($questionId);
                $answer->setUserId($user->getId());

                $em->persist($answer);
            }

            $em->flush();

            return $this->renderBet($name);
        } else {
            $questionRepository = $this->getDoctrine()->getRepository('AppBundle:Question');
            $questions = $questionRepository->findAll();
            $openQuestions = $questionRepository->findBy(array('type' => 1));
            $coachQuestions = $questionRepository->findBy(array('type' => 2));
            $selectBuli1Questions = $questionRepository->findBy(array('type' => 3));
            $selectKreisligaQuestions = $questionRepository->findBy(array('type' => 4));
            $selectAklasseQuestions = $questionRepository->findBy(array('type' => 5));
            $placementAichQuestions = $questionRepository->findBy(array('type' => 6));
            $roundQuestions = $questionRepository->findBy(array('type' => 7));
            $placementBuli1Questions = $questionRepository->findBy(array('type' => 8));
            $placementBuli2Questions = $questionRepository->findBy(array('type' => 9));

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

            return $this->render('default/user.html.twig', array(
                        'questions' => $questions,
                        'openQuestions' => $openQuestions,
                        'coachQuestions' => $coachQuestions,
                        'selectBuli1Questions' => $selectBuli1Questions,
                        'selectKreisligaQuestions' => $selectKreisligaQuestions,
                        'selectAklasseQuestions' => $selectAklasseQuestions,
                        'placementAichQuestions' => $placementAichQuestions,
                        'roundQuestions' => $roundQuestions,
                        'placementBuli1Questions' => $placementBuli1Questions,
                        'placementBuli2Questions' => $placementBuli2Questions,
                        'buliTeams' => $buliTeams,
                        'buli2Teams' => $buli2Teams,
                        'kreisligaTeams' => $kreisligaTeams,
                        'aklassenTeams' => $aklassenTeams,
                        'rounds' => $rounds
            ));
        }
    }

    private function renderBet($name) {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Game');
        $games = $repository->findAll();

        $leagueRepo = $this->getDoctrine()->getRepository('AppBundle:League');
        $national = $leagueRepo->findOneBy(array('name' => 'Nationalmannschaft'));
        $bundesliga = $leagueRepo->findOneBy(array('name' => '1.Bundesliga'));        
        $kreisliga = $leagueRepo->findOneBy(array('name' => 'Kreisliga I'));
        $aklasse = $leagueRepo->findOneBy(array('name' => 'A-Klasse I'));

        $gameRepo = $this->getDoctrine()->getRepository('AppBundle:Game');
        $bayernGames = $gameRepo->findBy(array('league' => $bundesliga));
        $natiGames = $gameRepo->findBy(array('league' => $national));
        $aichIGames = $gameRepo->findBy(array('league' => $kreisliga));
        $aichIIGames = $gameRepo->findBy(array('league' => $aklasse));

        return $this->render('default/bet.html.twig', array(
                    'name' => $name,
                    'games' => $games,
                    'bayernGames' => $bayernGames,
                    'natiGames' => $natiGames,
                    'aichIGames' => $aichIGames,
                    'aichIIGames' => $aichIIGames,
        ));
    }

    private function renderFinish($name) {
        return $this->render('default/finish.html.twig', array(
                    'name' => $name
        ));
    }

    /**
     * @Route("/bet", name="bet")
     */
    public function betAction(Request $request) {
        $post = Request::createFromGlobals();
        $session = $request->getSession();
        $name = $session->get('userName');

        if ($post->request->has('submit')) {
            $userId = $session->get('userId');
            $em = $this->getDoctrine()->getManager();

            $initalGameIndex = $post->request->get('gameInitalIndex');
            $gameCount = $post->request->get('gameCount');

            for ($initalGameIndex; $initalGameIndex <= $gameCount; $initalGameIndex++) {
                $gameId = $post->request->get('gameId' . $initalGameIndex);
                $homeTeamScore = $post->request->get('betHometeamScore' . $initalGameIndex);
                $guestTeamScore = $post->request->get('betGuestteamScore' . $initalGameIndex);

                $bet = new Bet();
                $bet->setHomeTeamScore($homeTeamScore);
                $bet->setGuestTeamScore($guestTeamScore);
                $bet->setGameId($gameId);
                $bet->setUserId(1);

                $em->persist($bet);
            }
            $em->flush();

            return $this->renderFinish($name);
        } else {
            return $this->renderBet($name);
        }
    }

}