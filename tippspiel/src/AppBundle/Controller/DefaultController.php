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
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        return $this->redirectToRoute('user');
    }

    /**
     * @Route("/ranking", name="ranking")
     */
    public function rankingAction(Request $request) {
        return $this->render('default/ranking.html.twig', array(
        ));
    }

    /**
     * @Route("/allGames", name="allGames")
     */
    public function allGamesAction(Request $request) {
        $gameRepo = $this->getDoctrine()->getRepository('AppBundle:Game');
        $games = $gameRepo->findAll();        
        return $this->render('default/allGames.html.twig', array(
                    'games' => $games
        ));
    }

    /**
     * @Route("/allQuestions", name="allQuestions")
     */
    public function allQuestionsAction(Request $request) {
        $questionRepo = $this->getDoctrine()->getRepository('AppBundle:Question');
        $questions = $questionRepo->findAll();
        return $this->render('default/allQuestions.html.twig', array(
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

        return $this->render('default/userSearch.html.twig', array(
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

        return $this->render('default/detail.html.twig', array(
                    'user' => $user,
                    'answers' => $answers,
                    'bets' => $bets
        ));
    }

    /**
     * @Route("/user", name="user")
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
            $user->setComplete(0);
            $em->persist($user);
            $em->flush();

            $session = $request->getSession();
            $session->set('userName', $name);
            $session->set('userId', $user->getId());

            $initalQuestionIndex = $post->request->get('questionInitalIndex');
            $questionCount = $post->request->get('questionCount');

            $questionRepository = $this->getDoctrine()->getRepository('AppBundle:Question');

            for ($initalQuestionIndex; $initalQuestionIndex <= $questionCount; $initalQuestionIndex++) {
                $answerText = $post->request->get('answer' . $initalQuestionIndex);
                $questionId = $post->request->get('questionId' . $initalQuestionIndex);
                $question = $questionRepository->findOneById($questionId);

                $answer = new Answer();
                $answer->setAnswer($answerText);
                $answer->setQuestion($question);
                $answer->setUser($user);

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

    /**
     * @Route("/info", name="info")
     */
    public function infoAction(Request $request) {
        return $this->render('default/info.html.twig', array(
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

        return $this->render('default/userDetail.html.twig', array(
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

        return $this->render('default/gameDetail.html.twig', array(
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

        return $this->render('default/questionDetail.html.twig', array(
                    'question' => $question,
                    'answers' => $answers
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

            $gameRepository = $this->getDoctrine()->getRepository('AppBundle:Game');
            $repository = $this->getDoctrine()->getRepository('AppBundle:User');
            $user = $repository->findOneById($userId);

            $initalGameIndex = $post->request->get('gameInitalIndex');
            $gameCount = $post->request->get('gameCount');

            for ($initalGameIndex; $initalGameIndex <= $gameCount; $initalGameIndex++) {
                $gameId = $post->request->get('gameId' . $initalGameIndex);
                $game = $gameRepository->findOneById($gameId);
                $homeTeamScore = $post->request->get('betHometeamScore' . $initalGameIndex);
                $guestTeamScore = $post->request->get('betGuestteamScore' . $initalGameIndex);

                $bet = new Bet();
                $bet->setHomeTeamScore($homeTeamScore);
                $bet->setGuestTeamScore($guestTeamScore);
                $bet->setGame($game);
                $bet->setUser($user);

                $em->persist($bet);
            }

            $user->setComplete(true);
            $em->flush();

            return $this->renderFinish($name);
        } else {
            return $this->renderBet($name);
        }
    }

    private function renderBet($name) {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Game');
        $games = $repository->findAll();

        $leagueRepo = $this->getDoctrine()->getRepository('AppBundle:League');
        $national = $leagueRepo->findOneBy(array('name' => 'Nationalmannschaft'));
        $bundesliga = $leagueRepo->findOneBy(array('name' => '1.Bundesliga'));
        $bundesliga2 = $leagueRepo->findOneBy(array('name' => '2.Bundesliga'));
        $kreisliga = $leagueRepo->findOneBy(array('name' => 'Kreisliga I'));
        $aklasse = $leagueRepo->findOneBy(array('name' => 'A-Klasse I'));

        $gameRepo = $this->getDoctrine()->getRepository('AppBundle:Game');
        $bayernGames = $gameRepo->findBy(array('league' => $bundesliga));
        $sechzigGames = $gameRepo->findBy(array('league' => $bundesliga2));
        $natiGames = $gameRepo->findBy(array('league' => $national));
        $aichIGames = $gameRepo->findBy(array('league' => $kreisliga));
        $aichIIGames = $gameRepo->findBy(array('league' => $aklasse));

        return $this->render('default/bet.html.twig', array(
                    'name' => $name,
                    'games' => $games,
                    'bayernGames' => $bayernGames,
                    'sechzigGames' => $sechzigGames,
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

}
