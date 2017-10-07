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
        $game->setGuestTeam($this->getReference('igling'));
        $game->setMatchDate(new \DateTime('2017-09-09'));
        $game->setLeague($this->getReference('kreisliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aich'));
        $game->setGuestTeam($this->getReference('oberweikertshofenII'));
        $game->setMatchDate(new \DateTime('2017-10-03'));
        $game->setLeague($this->getReference('kreisliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aich'));
        $game->setGuestTeam($this->getReference('denklingen'));
        $game->setMatchDate(new \DateTime('2017-10-11'));
        $game->setLeague($this->getReference('kreisliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aich'));
        $game->setGuestTeam($this->getReference('altenstadt'));
        $game->setMatchDate(new \DateTime('2017-10-14'));
        $game->setLeague($this->getReference('kreisliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aich'));
        $game->setGuestTeam($this->getReference('poecking'));
        $game->setMatchDate(new \DateTime('2017-10-19'));
        $game->setLeague($this->getReference('kreisliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aich'));
        $game->setGuestTeam($this->getReference('peiting'));
        $game->setMatchDate(new \DateTime('2017-10-28'));
        $game->setLeague($this->getReference('kreisliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aich'));
        $game->setGuestTeam($this->getReference('mammendorf'));
        $game->setMatchDate(new \DateTime('2017-11-04'));
        $game->setLeague($this->getReference('kreisliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aich'));
        $game->setGuestTeam($this->getReference('unterpfaffenhofen'));
        $game->setMatchDate(new \DateTime('2018-04-07'));
        $game->setLeague($this->getReference('kreisliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aich'));
        $game->setGuestTeam($this->getReference('maisach'));
        $game->setMatchDate(new \DateTime('2018-04-21'));
        $game->setLeague($this->getReference('kreisliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aich'));
        $game->setGuestTeam($this->getReference('landsberg'));
        $game->setMatchDate(new \DateTime('2018-05-15'));
        $game->setLeague($this->getReference('kreisliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aich'));
        $game->setGuestTeam($this->getReference('emmering'));
        $game->setMatchDate(new \DateTime('2018-05-12'));
        $game->setLeague($this->getReference('kreisliga'));
        $manager->persist($game);
        
        $game = new Game();
        $game->setHomeTeam($this->getReference('aich'));
        $game->setGuestTeam($this->getReference('groebenzell'));
        $game->setMatchDate(new \DateTime('2018-05-27'));
        $game->setLeague($this->getReference('kreisliga'));
        $manager->persist($game);        

        //A-KLASSE
        $game = new Game();
        $game->setHomeTeam($this->getReference('aichII'));
        $game->setGuestTeam($this->getReference('wildenroth'));
        $game->setMatchDate(new \DateTime('2017-09-09'));
        $game->setLeague($this->getReference('aklasse'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aichII'));
        $game->setGuestTeam($this->getReference('geltendorf'));
        $game->setMatchDate(new \DateTime('2017-09-23'));
        $game->setLeague($this->getReference('aklasse'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aichII'));
        $game->setGuestTeam($this->getReference('oberweikershofenIII'));
        $game->setMatchDate(new \DateTime('2017-10-03'));
        $game->setLeague($this->getReference('aklasse'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aichII'));
        $game->setGuestTeam($this->getReference('jesenwang'));
        $game->setMatchDate(new \DateTime('2017-10-14'));
        $game->setLeague($this->getReference('aklasse'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aichII'));
        $game->setGuestTeam($this->getReference('landsberied'));
        $game->setMatchDate(new \DateTime('2017-10-28'));
        $game->setLeague($this->getReference('aklasse'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aichII'));
        $game->setGuestTeam($this->getReference('mammendorfII'));
        $game->setMatchDate(new \DateTime('2017-11-04'));
        $game->setLeague($this->getReference('aklasse'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aichII'));
        $game->setGuestTeam($this->getReference('tuerkenfeld'));
        $game->setMatchDate(new \DateTime('2018-04-07'));
        $game->setLeague($this->getReference('aklasse'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aichII'));
        $game->setGuestTeam($this->getReference('maisachII'));
        $game->setMatchDate(new \DateTime('2018-04-21'));
        $game->setLeague($this->getReference('aklasse'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aichII'));
        $game->setGuestTeam($this->getReference('schoengeising'));
        $game->setMatchDate(new \DateTime('2017-05-05'));
        $game->setLeague($this->getReference('aklasse'));
        $manager->persist($game);
        
        $game = new Game();
        $game->setHomeTeam($this->getReference('aichII'));
        $game->setGuestTeam($this->getReference('malching'));
        $game->setMatchDate(new \DateTime('2017-04-21'));
        $game->setLeague($this->getReference('aklasse'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('aichII'));
        $game->setGuestTeam($this->getReference('haspelmoor'));
        $game->setMatchDate(new \DateTime('2017-05-26'));
        $game->setLeague($this->getReference('aklasse'));
        $manager->persist($game);        

        //NATIONALMANNSCHAFT
        $game = new Game();
        $game->setHomeTeam($this->getReference('nordirland'));
        $game->setGuestTeam($this->getReference('deutschland'));
        $game->setMatchDate(new \DateTime('2017-10-05'));
        $game->setLeague($this->getReference('nationalmannschaft'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('deutschland'));
        $game->setGuestTeam($this->getReference('aserbaidschan'));
        $game->setMatchDate(new \DateTime('2017-11-08'));
        $game->setLeague($this->getReference('nationalmannschaft'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('deutschland'));
        $game->setGuestTeam($this->getReference('spanien'));
        $game->setMatchDate(new \DateTime('2018-03-23'));
        $game->setLeague($this->getReference('nationalmannschaft'));
        $manager->persist($game);
        
        $game = new Game();
        $game->setHomeTeam($this->getReference('deutschland'));
        $game->setGuestTeam($this->getReference('brasilien'));
        $game->setMatchDate(new \DateTime('2018-03-27'));
        $game->setLeague($this->getReference('nationalmannschaft'));
        $manager->persist($game);        

//        //BUNDESLIGA
        $game = new Game();
        $game->setHomeTeam($this->getReference('hoffenheim'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(3);
        $game->setLeague($this->getReference('1.bundesliga'));
        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('bayern'));
        $game->setGuestTeam($this->getReference('wolfsburg'));
        $game->setMatchDay(6);
        $game->setLeague($this->getReference('1.bundesliga'));
        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('hertha'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(7);
        $game->setLeague($this->getReference('1.bundesliga'));
        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('bayern'));
        $game->setGuestTeam($this->getReference('freiburg'));
        $game->setMatchDay(8);
        $game->setLeague($this->getReference('1.bundesliga'));
        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('bayern'));
        $game->setGuestTeam($this->getReference('leipzig'));
        $game->setMatchDay(10);
        $game->setLeague($this->getReference('1.bundesliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('dortmund'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(11);
        $game->setLeague($this->getReference('1.bundesliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('gladbach'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(13);
        $game->setLeague($this->getReference('1.bundesliga'));
        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('leverkusen'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(18);
        $game->setLeague($this->getReference('1.bundesliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('bayern'));
        $game->setGuestTeam($this->getReference('schalke'));
        $game->setMatchDay(22);
        $game->setLeague($this->getReference('1.bundesliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('augsburg'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(29);
        $game->setLeague($this->getReference('1.bundesliga'));
        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('hannover'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(31);
        $game->setLeague($this->getReference('1.bundesliga'));
        $manager->persist($game);

        $game = new Game();
        $game->setHomeTeam($this->getReference('koeln'));
        $game->setGuestTeam($this->getReference('bayern'));
        $game->setMatchDay(33);
        $game->setLeague($this->getReference('1.bundesliga'));
        $manager->persist($game);        

        $game = new Game();
        $game->setHomeTeam($this->getReference('bayern'));
        $game->setGuestTeam($this->getReference('stuttgart'));
        $game->setMatchDay(34);
        $game->setLeague($this->getReference('1.bundesliga'));
        $manager->persist($game);        


        $manager->flush();
    }

    public function getOrder() {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 3;
    }

}
