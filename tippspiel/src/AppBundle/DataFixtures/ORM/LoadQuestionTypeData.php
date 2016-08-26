<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\QuestionType;

/**
 * Description of LoadQuestionTypeData
 *
 * @author davidfehr
 */
class LoadQuestionTypeData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        
        $type = new QuestionType();
        $type->setName('OPEN_QUESTION');
        $this->setReference('open', $type);
        $manager->persist($type);

        $type = new QuestionType();
        $type->setName('SELECTION');
        $this->setReference('select', $type);
        $manager->persist($type);
        
        $type = new QuestionType();
        $type->setName('SELECTION_TEAM_BULI');
        $this->setReference('select_buli', $type);
        $manager->persist($type);

        $type = new QuestionType();
        $type->setName('SELECTION_TEAM_KREISLIGA');
        $this->setReference('select_kreisliga', $type);
        $manager->persist($type);        
        
        $type = new QuestionType();
        $type->setName('SELECTION_TEAM_AKLASSE');
        $this->setReference('select_aklasse', $type);
        $manager->persist($type);
        
        $type = new QuestionType();
        $type->setName('SELECTION_COUNT');
        $this->setReference('select_count', $type);
        $manager->persist($type);  
        
        $type = new QuestionType();
        $type->setName('SELECTION_ROUND');
        $this->setReference('select_round', $type);
        $manager->persist($type);   
        
        $type = new QuestionType();
        $type->setName('PLACEMENT_BULI');
        $this->setReference('placement_buli', $type);
        $manager->persist($type);  

        $type = new QuestionType();
        $type->setName('PLACEMENT_BULI2');
        $this->setReference('placement_buli2', $type);
        $manager->persist($type);          
        
        $manager->flush();
    }

    public function getOrder() {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }

}
