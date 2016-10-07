<?php 
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateRankingCommand extends ContainerAwareCommand
{
    protected function configure()
    {
    $this
        ->setName('app:create:ranking')
        ->setDescription('creates new ranking')
    ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        
        $userRepo = $em->getRepository('AppBundle:User');
        $users = $userRepo->getAllPlayer();  
        
        $usersArray = array();
        foreach($users as $user) {
            $userInfo = array();
            $userInfo[0] = $user;
            $userInfo[1] = 0;
            $usersArray[$user->getId()] = $userInfo;
        }        
        
        $questionRepo = $em->getRepository('AppBundle:Question');
        $questions = $questionRepo->getFinishedQuestions();
        $answerRepo = $em->getRepository('AppBundle:Answer');
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
        
        $gameRepo = $em->getRepository('AppBundle:Game');
        $games = $gameRepo->getFinishedGames();        
        $betRepo = $em->getRepository('AppBundle:Bet');
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
       
    }
}