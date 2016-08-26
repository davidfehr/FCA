<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Round;

/**
 * Description of LoadRoundData
 *
 * @author davidfehr
 */
class LoadRoundData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        
        $round = new Round();
        $round->setName('nicht qualifiziert');
        $manager->persist($round);

        $round = new Round();
        $round->setName('Erste Runde');
        $manager->persist($round);
        
        $round = new Round();
        $round->setName('Gruppenphase');
        $manager->persist($round);

        $round = new Round();
        $round->setName('Sechzehntelfinale');
        $manager->persist($round);        
        
        $round = new Round();
        $round->setName('Achtelfinale');
        $manager->persist($round);

        $round = new Round();
        $round->setName('Viertelfinale');
        $manager->persist($round);

        $round = new Round();
        $round->setName('Halbfinale');
        $manager->persist($round);

        $round = new Round();
        $round->setName('Finale');
        $manager->persist($round); 
        
        $round = new Round();
        $round->setName('Sieger');
        $manager->persist($round);         
        
        $manager->flush();
    }

    public function getOrder() {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }

}
