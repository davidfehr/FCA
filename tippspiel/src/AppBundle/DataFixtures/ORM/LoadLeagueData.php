<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\League;

/**
 * Description of LoadPossibleAnswerData
 *
 * @author davidfehr
 */
class LoadLeagueData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        
        $league = new League();
        $league->setName('Kreisliga I');
        $this->addReference('kreisliga', $league);
        $manager->persist($league);
        
        $league = new League();
        $league->setName('A-Klasse I');
        $this->addReference('aklasse', $league);
        $manager->persist($league);

        $league = new League();
        $league->setName('1.Bundesliga');
        $this->addReference('1.bundesliga', $league);
        $manager->persist($league);        

        $league = new League();
        $league->setName('2.Bundesliga');
        $this->addReference('2.bundesliga', $league);
        $manager->persist($league);  
        
        $league = new League();
        $league->setName('Nationalmannschaft');
        $this->addReference('nationalmannschaft', $league);
        $manager->persist($league);        
        
        $manager->flush();
    }

    public function getOrder() {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }

}
