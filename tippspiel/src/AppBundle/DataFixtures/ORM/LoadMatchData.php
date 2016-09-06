<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Game;

/**
 * Description of LoadMatchData
 *
 * @author davidfehr
 */
class LoadMatchData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        $game = new Game();
        $game->setHomeTeam($this->getReference('aich'));
        $game->setGuestTeam($this->getReference('penzing'));
        $game->setMatchDate(new \DateTime('2016-09-10'));
        $game->setLeague($this->getReference('kreisliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aich'));
        $game->setGuestTeam($this->getReference('unterpfaffenhofen'));
        $game->setMatchDate(new \DateTime('2016-09-21'));
        $game->setLeague($this->getReference('kreisliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aich'));
        $game->setGuestTeam($this->getReference('eurasburg'));
        $game->setMatchDate(new \DateTime('2016-10-08'));
        $game->setLeague($this->getReference('kreisliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aich'));
        $game->setGuestTeam($this->getReference('peiting'));
        $game->setMatchDate(new \DateTime('2016-10-15'));
        $game->setLeague($this->getReference('kreisliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aich'));
        $game->setGuestTeam($this->getReference('mammendorf'));
        $game->setMatchDate(new \DateTime('2016-11-05'));
        $game->setLeague($this->getReference('kreisliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aich'));
        $game->setGuestTeam($this->getReference('oberweikertshofen'));
        $game->setMatchDate(new \DateTime('2016-03-25'));
        $game->setLeague($this->getReference('kreisliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aich'));
        $game->setGuestTeam($this->getReference('gröbenzell'));
        $game->setMatchDate(new \DateTime('2017-04-01'));
        $game->setLeague($this->getReference('kreisliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aich'));
        $game->setGuestTeam($this->getReference('denklingen'));
        $game->setMatchDate(new \DateTime('2017-04-15'));
        $game->setLeague($this->getReference('kreisliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aich'));
        $game->setGuestTeam($this->getReference('bernbeuren'));
        $game->setMatchDate(new \DateTime('2017-04-29'));
        $game->setLeague($this->getReference('kreisliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aich'));
        $game->setGuestTeam($this->getReference('geiselbullach'));
        $game->setMatchDate(new \DateTime('2017-05-13'));
        $game->setLeague($this->getReference('kreisliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aich'));
        $game->setGuestTeam($this->getReference('ffb_west'));
        $game->setMatchDate(new \DateTime('2017-06-03'));
        $game->setLeague($this->getReference('kreisliga'));
        $manager->persist($game);

        //A-KLASSE
        $game = new Game();
        $game->setHomeTeam($this->getReference('aichII'));
        $game->setGuestTeam($this->getReference('penzingII'));
        $game->setMatchDate(new \DateTime('2016-09-10'));
        $game->setLeague($this->getReference('aklasse'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aichII'));
        $game->setGuestTeam($this->getReference('türkenfeld'));
        $game->setMatchDate(new \DateTime('2016-09-24'));
        $game->setLeague($this->getReference('aklasse'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aichII'));
        $game->setGuestTeam($this->getReference('schöngeising'));
        $game->setMatchDate(new \DateTime('2016-08-10'));
        $game->setLeague($this->getReference('aklasse'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aichII'));
        $game->setGuestTeam($this->getReference('geltendorf'));
        $game->setMatchDate(new \DateTime('2016-10-15'));
        $game->setLeague($this->getReference('aklasse'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aichII'));
        $game->setGuestTeam($this->getReference('mammendorfII'));
        $game->setMatchDate(new \DateTime('2016-11-05'));
        $game->setLeague($this->getReference('aklasse'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aichII'));
        $game->setGuestTeam($this->getReference('malching'));
        $game->setMatchDate(new \DateTime('2017-03-25'));
        $game->setLeague($this->getReference('aklasse'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aichII'));
        $game->setGuestTeam($this->getReference('jesenwang'));
        $game->setMatchDate(new \DateTime('2016-04-01'));
        $game->setLeague($this->getReference('aklasse'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aichII'));
        $game->setGuestTeam($this->getReference('haspelmoor'));
        $game->setMatchDate(new \DateTime('2017-04-29'));
        $game->setLeague($this->getReference('aklasse'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aichII'));
        $game->setGuestTeam($this->getReference('aufkirchen'));
        $game->setMatchDate(new \DateTime('2017-05-13'));
        $game->setLeague($this->getReference('aklasse'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aichII'));
        $game->setGuestTeam($this->getReference('überacker'));
        $game->setMatchDate(new \DateTime('2017-06-03'));
        $game->setLeague($this->getReference('aklasse'));
        $manager->persist($game);

        //NATIONALMANNSCHAFT
        $game = new Game();
        $game->setHomeTeam($this->getReference('deutschland'));
        $game->setGuestTeam($this->getReference('tschechische'));
        $game->setMatchDate(new \DateTime('2016-10-08'));
        $game->setLeague($this->getReference('nationalmannschaft'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('deutschland'));
        $game->setGuestTeam($this->getReference('nordirland'));
        $game->setMatchDate(new \DateTime('2016-10-11'));
        $game->setLeague($this->getReference('nationalmannschaft'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('sanmarino'));
        $game->setGuestTeam($this->getReference('deutschland'));
        $game->setMatchDate(new \DateTime('2016-11-13'));
        $game->setLeague($this->getReference('nationalmannschaft'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('italien'));
        $game->setGuestTeam($this->getReference('deutschland'));
        $game->setMatchDate(new \DateTime('2016-11-15'));
        $game->setLeague($this->getReference('nationalmannschaft'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aserbaidschan'));
        $game->setGuestTeam($this->getReference('deutschland'));
        $game->setMatchDate(new \DateTime('2017-03-26'));
        $game->setLeague($this->getReference('nationalmannschaft'));
        $manager->persist($game);

//        //BUNDESLIGA
        $game = new Game();
        $game->setHomeTeam($this->getReference('bayern'));
        $game->setGuestTeam($this->getReference('ingolstadt'));
        $game->setMatchDay(3);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('bayern'));
        $game->setGuestTeam($this->getReference('berlin'));
        $game->setMatchDay(4);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('hamburg'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(5);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('bayern'));
        $game->setGuestTeam($this->getReference('köln'));
        $game->setMatchDay(6);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('frankfurt'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(7);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('bayern'));
        $game->setGuestTeam($this->getReference('gladbach'));
        $game->setMatchDay(8);
        $game->setLeague($this->getReference('1.bundesliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('augsburg'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(9);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('bayern'));
        $game->setGuestTeam($this->getReference('hoffenheim'));
        $game->setMatchDay(10);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('dortmund'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(11);
        $game->setLeague($this->getReference('1.bundesliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('bayern'));
        $game->setGuestTeam($this->getReference('leverkusen'));
        $game->setMatchDay(12);
        $game->setLeague($this->getReference('1.bundesliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('mainz'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(13);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('bayern'));
        $game->setGuestTeam($this->getReference('wolfsburg'));
        $game->setMatchDay(14);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('darmstadt'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(15);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('bayern'));
        $game->setGuestTeam($this->getReference('leipzig'));
        $game->setMatchDay(16);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('freiburg'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(17);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('bremen'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(18);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('bayern'));
        $game->setGuestTeam($this->getReference('schalke'));
        $game->setMatchDay(19);
        $game->setLeague($this->getReference('1.bundesliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('berlin'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(20);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('bayern'));
        $game->setGuestTeam($this->getReference('hamburg'));
        $game->setMatchDay(21);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('ingolstadt'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(22);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('köln'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(23);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('bayern'));
        $game->setGuestTeam($this->getReference('frankfurt'));
        $game->setMatchDay(24);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('gladbach'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(25);
        $game->setLeague($this->getReference('1.bundesliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('bayern'));
        $game->setGuestTeam($this->getReference('augsburg'));
        $game->setMatchDay(26);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('hoffenheim'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(27);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);        


        $game = new Game();
        $game->setHomeTeam($this->getReference('bayern'));
        $game->setGuestTeam($this->getReference('dortmund'));
        $game->setMatchDay(28);
        $game->setLeague($this->getReference('1.bundesliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('leverkusen'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(29);
        $game->setLeague($this->getReference('1.bundesliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('bayern'));
        $game->setGuestTeam($this->getReference('mainz'));
        $game->setMatchDay(30);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('wolfsburg'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(31);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('bayern'));
        $game->setGuestTeam($this->getReference('darmstadt'));
        $game->setMatchDay(32);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('leipzig'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(33);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('bayern'));
        $game->setGuestTeam($this->getReference('freiburg'));
        $game->setMatchDay(34);
        $game->setLeague($this->getReference('1.bundesliga'));
//        $manager->persist($game);  
//        
//                    
        //2.BUNDESLIGA        
        $game = new Game();
        $game->setHomeTeam($this->getReference('nürnberg'));
        $game->setGuestTeam($this->getReference('münchen'));
        $game->setMatchDay(4);
        $game->setLeague($this->getReference('2.bundesliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('pauli'));
        $game->setGuestTeam($this->getReference('münchen'));
        $game->setMatchDay(6);
        $game->setLeague($this->getReference('2.bundesliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('münchen'));
        $game->setGuestTeam($this->getReference('stuttgart'));
        $game->setMatchDay(10);
        $game->setLeague($this->getReference('2.bundesliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('münchen'));
        $game->setGuestTeam($this->getReference('dresden'));
        $game->setMatchDay(15);
        $game->setLeague($this->getReference('2.bundesliga'));
        //$manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('münchen'));
        $game->setGuestTeam($this->getReference('nürnberg'));
        $game->setMatchDay(21);
        $game->setLeague($this->getReference('2.bundesliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('münchen'));
        $game->setGuestTeam($this->getReference('pauli'));
        $game->setMatchDay(23);
        $game->setLeague($this->getReference('2.bundesliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('stuttgart'));
        $game->setGuestTeam($this->getReference('münchen'));
        $game->setMatchDay(27);
        $game->setLeague($this->getReference('2.bundesliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('dresden'));
        $game->setGuestTeam($this->getReference('münchen'));
        $game->setMatchDay(32);
        $game->setLeague($this->getReference('2.bundesliga'));
        //$manager->persist($game);

        $manager->flush();
    }

    public function getOrder() {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 3;
    }

}
