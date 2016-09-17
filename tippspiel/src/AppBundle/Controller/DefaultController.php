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
     * @Route("/info", name="info")
     */
    public function infoAction(Request $request) {
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
     * @Route("/detail", name="detail")
     */
    public function detailAction(Request $request) {
        $post = Request::createFromGlobals();
        if ($post->request->has('submit')) {
            $name = $post->request->get('name');
        } else {
            $usersRepo = $this->getDoctrine()->getRepository('AppBundle:User');
            $users = $usersRepo->findBy(array('complete' => 1));

            return $this->render('default/info.html.twig', array(
                        'users' => $users
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
