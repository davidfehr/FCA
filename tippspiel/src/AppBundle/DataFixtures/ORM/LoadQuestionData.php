<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Question;

/**
 * Description of LoadQuestionData
 *
 * @author davidfehr
 */
class LoadQuestionData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        
        $question = new Question();
        $question->setQuestion('Wer wird Pokalsieger?');
        $question->setType($this->getReference('cup'));
        $manager->persist($question);         
        
        $question = new Question();
        $question->setQuestion('Wer wird Championsleague Sieger?');
        $question->setType($this->getReference('cup'));
        $manager->persist($question);           

        $question = new Question();
        $question->setQuestion('Wer wird Top-Torjäger in der Bundesliga?');
        $question->setType($this->getReference('open'));
        $manager->persist($question);
        
        $question = new Question();
        $question->setQuestion('Wer wird Meister in Spanien?');
        $question->setType($this->getReference('open'));
        $manager->persist($question);

        $question = new Question();
        $question->setQuestion('Wer wird Meister in Italien?');
        $question->setType($this->getReference('open'));
        $manager->persist($question);
        
        $question = new Question();
        $question->setQuestion('Wer wird Meister in England?');
        $question->setType($this->getReference('open'));
        $manager->persist($question);

        $question = new Question();
        $question->setQuestion('Wer wird Meister in Frankreich?');
        $question->setType($this->getReference('open'));
        $manager->persist($question);        
        
        $question = new Question();
        $question->setQuestion('Welcher Bundesliga Trainer wird zuerst entlassen?');
        $question->setType($this->getReference('select'));
        $this->setReference('buli_trainer', $question);
        $manager->persist($question); 

        $question = new Question();
        $question->setQuestion('Wie weit kommt Bayern in der CL?');
        $question->setType($this->getReference('select_round'));        
        $manager->persist($question); 
        
        $question = new Question();
        $question->setQuestion('Wie weit kommt Leipzig in der CL?');
        $question->setType($this->getReference('select_round'));        
        $manager->persist($question); 

        $question = new Question();
        $question->setQuestion('Wie weit kommt Dortmund in der CL?');
        $question->setType($this->getReference('select_round'));        
        $manager->persist($question); 

        $question = new Question();
        $question->setQuestion('Wie weit kommt Hoffenheim in der EL?');
        $question->setType($this->getReference('select_round'));        
        $manager->persist($question);         
        
        $question = new Question();
        $question->setQuestion('Wie weit kommt Köln in der EL?');
        $question->setType($this->getReference('select_round'));        
        $manager->persist($question);         

        $question = new Question();
        $question->setQuestion('Wie weit kommt Hertha in der EL?');
        $question->setType($this->getReference('select_round'));        
        $manager->persist($question);                 
        
        $question = new Question();
        $question->setQuestion('Wer wird Kreisliga Meister?');
        $question->setType($this->getReference('select_kreisliga'));
        $manager->persist($question);  
        
        $question = new Question();
        $question->setQuestion('Welchen Platz belegt der FCA I nach der Hinrunde?');
        $question->setType($this->getReference('select_count'));
        $manager->persist($question);          
        
        $question = new Question();
        $question->setQuestion('Welchen Platz belegt der FCA I nach der Rückrunde?');
        $question->setType($this->getReference('select_count'));
        $manager->persist($question);                  

        $question = new Question();
        $question->setQuestion('Wer wird Top-Torjäger bei Aich I (Kreisliga)?');
        $question->setType($this->getReference('open'));
        $manager->persist($question);        
        
        $question = new Question();
        $question->setQuestion('Wer wird A-Klassen Meister?');
        $question->setType($this->getReference('select_aklasse'));
        $manager->persist($question);    
        
        $question = new Question();
        $question->setQuestion('Welchen Platz belegt der FCA II nach der Hinrunde?');
        $question->setType($this->getReference('select_count'));
        $manager->persist($question);          
        
        $question = new Question();
        $question->setQuestion('Welchen Platz belegt der FCA II nach der Rückrunde?');
        $question->setType($this->getReference('select_count'));
        $manager->persist($question);         
        
        $question = new Question();
        $question->setQuestion('Wer wird Top-Torjäger bei Aich II (A-Klasse)?');
        $question->setType($this->getReference('open'));
        $manager->persist($question);        
        
        $question = new Question();
        $question->setQuestion('1.Platz (Meister)');
        $question->setType($this->getReference('placement_buli'));
        $manager->persist($question);    
        
        $question = new Question();
        $question->setQuestion('2.Platz (CL)');
        $question->setType($this->getReference('placement_buli'));
        $manager->persist($question);    

        $question = new Question();
        $question->setQuestion('3.Platz (CL)');
        $question->setType($this->getReference('placement_buli'));
        $manager->persist($question);    

        $question = new Question();
        $question->setQuestion('4.Platz (Quali)');
        $question->setType($this->getReference('placement_buli'));
        $manager->persist($question);    

        $question = new Question();
        $question->setQuestion('5.Platz (Europa League)');
        $question->setType($this->getReference('placement_buli'));
        $manager->persist($question);    

        $question = new Question();
        $question->setQuestion('6.Platz (Europa League)');
        $question->setType($this->getReference('placement_buli'));
        $manager->persist($question);    

        $question = new Question();
        $question->setQuestion('16.Platz (Relegation)');
        $question->setType($this->getReference('placement_buli'));
        $manager->persist($question);    

        $question = new Question();
        $question->setQuestion('17.Platz (Abstieg)');
        $question->setType($this->getReference('placement_buli'));
        $manager->persist($question);    

        $question = new Question();
        $question->setQuestion('18.Platz (Abstieg)');
        $question->setType($this->getReference('placement_buli'));
        $manager->persist($question);            

        $question = new Question();
        $question->setQuestion('1.Platz (Aufstieg)');
        $question->setType($this->getReference('placement_buli2'));
        $manager->persist($question);    
        
        $question = new Question();
        $question->setQuestion('2.Platz (Aufstieg)');
        $question->setType($this->getReference('placement_buli2'));
        $manager->persist($question);    

        $question = new Question();
        $question->setQuestion('3.Platz (Relegation)');
        $question->setType($this->getReference('placement_buli2'));
        $manager->persist($question);    
  
        $question = new Question();
        $question->setQuestion('16.Platz (Relegation)');
        $question->setType($this->getReference('placement_buli2'));
        $manager->persist($question);    

        $question = new Question();
        $question->setQuestion('17.Platz (Abstieg)');
        $question->setType($this->getReference('placement_buli2'));
        $manager->persist($question);    

        $question = new Question();
        $question->setQuestion('18.Platz (Abstieg)');
        $question->setType($this->getReference('placement_buli2'));
        $manager->persist($question);         
        
        $manager->flush();
    }

    public function getOrder() {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 2;
    }

}
