<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\PossibleAnswer;

/**
 * Description of LoadPossibleAnswerData
 *
 * @author davidfehr
 */
class LoadPossibleAnswerData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        
        $answer = new PossibleAnswer();
        $answer->setAnswer('Carlos Ancelotti');
        $answer->setQuestion($this->getReference('buli_trainer'));
        $manager->persist($answer);

        $answer = new PossibleAnswer();
        $answer->setAnswer('Thomas Tuchel');
        $answer->setQuestion($this->getReference('buli_trainer'));
        $manager->persist($answer);
        
        $answer = new PossibleAnswer();
        $answer->setAnswer('Roger Schmidt');
        $answer->setQuestion($this->getReference('buli_trainer'));
        $manager->persist($answer);        
        
        $answer = new PossibleAnswer();
        $answer->setAnswer('Peter Stöger');
        $answer->setQuestion($this->getReference('buli_trainer'));
        $manager->persist($answer);              
        
        $answer = new PossibleAnswer();
        $answer->setAnswer('Julian Nagelsmann');
        $answer->setQuestion($this->getReference('buli_trainer'));
        $manager->persist($answer);             

        $answer = new PossibleAnswer();
        $answer->setAnswer('Niko Kovac');
        $answer->setQuestion($this->getReference('buli_trainer'));
        $manager->persist($answer);          

        $answer = new PossibleAnswer();
        $answer->setAnswer('Pal Dardei');
        $answer->setQuestion($this->getReference('buli_trainer'));
        $manager->persist($answer);   

        $answer = new PossibleAnswer();
        $answer->setAnswer('Andre Schubert');
        $answer->setQuestion($this->getReference('buli_trainer'));
        $manager->persist($answer); 
        
        $answer = new PossibleAnswer();
        $answer->setAnswer('Christan Streich');
        $answer->setQuestion($this->getReference('buli_trainer'));
        $manager->persist($answer);           
        
        $answer = new PossibleAnswer();
        $answer->setAnswer('Ralph Hasenhüttl');
        $answer->setQuestion($this->getReference('buli_trainer'));
        $manager->persist($answer);           
        
        $answer = new PossibleAnswer();
        $answer->setAnswer('Martin Schmidt');
        $answer->setQuestion($this->getReference('buli_trainer'));
        $manager->persist($answer);
        
        $answer = new PossibleAnswer();
        $answer->setAnswer('Bruno Labbadia');
        $answer->setQuestion($this->getReference('buli_trainer'));
        $manager->persist($answer);           
        
        $answer = new PossibleAnswer();
        $answer->setAnswer('Viktor Skripnik');
        $answer->setQuestion($this->getReference('buli_trainer'));
        $manager->persist($answer);        
        
        $answer = new PossibleAnswer();
        $answer->setAnswer('Dirk Schuster');
        $answer->setQuestion($this->getReference('buli_trainer'));
        $manager->persist($answer);      

        $answer = new PossibleAnswer();
        $answer->setAnswer('Norbert Meier');
        $answer->setQuestion($this->getReference('buli_trainer'));
        $manager->persist($answer);      
        
        $answer = new PossibleAnswer();
        $answer->setAnswer('Markus Weinzierl');
        $answer->setQuestion($this->getReference('buli_trainer'));
        $manager->persist($answer);         
        
        $answer = new PossibleAnswer();
        $answer->setAnswer('Dieter Hecking');
        $answer->setQuestion($this->getReference('buli_trainer'));
        $manager->persist($answer);       
        
        $answer = new PossibleAnswer();
        $answer->setAnswer('Markus Kauczinski');
        $answer->setQuestion($this->getReference('buli_trainer'));
        $manager->persist($answer);   

        $manager->flush();        
    }
    

    public function getOrder() {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 4;
    }

}
