<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Team;

/**
 * Description of LoadTeamData
 *
 * @author davidfehr
 */
class LoadTeamData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        $team = new Team();
        $team->setName('FC Aich');
        $this->addReference('aich', $team);
        $team->setLeague($this->getReference('kreisliga'));
        $manager->persist($team);

        $team = new Team();
        $team->setName('Vfl Denklingen');
        $this->addReference('denklingen', $team);
        $team->setLeague($this->getReference('kreisliga'));
        $manager->persist($team);

        $team = new Team();
        $team->setName('SC Unterpfaffenhofen');
        $this->addReference('unterpfaffenhofen', $team);
        $team->setLeague($this->getReference('kreisliga'));
        $manager->persist($team);

        $team = new Team();
        $team->setName('TSV Peiting');
        $this->addReference('peiting', $team);
        $team->setLeague($this->getReference('kreisliga'));
        $manager->persist($team);

        $team = new Team();
        $team->setName('FC Penzing');
        $this->addReference('penzing', $team);
        $team->setLeague($this->getReference('kreisliga'));
        $manager->persist($team);

        $team = new Team();
        $team->setName('SV Eurasburg-Beuerberg');
        $this->addReference('eurasburg', $team);
        $team->setLeague($this->getReference('kreisliga'));
        $manager->persist($team);

        $team = new Team();
        $team->setName('TSV Geiselbullach');
        $this->addReference('geiselbullach', $team);
        $team->setLeague($this->getReference('kreisliga'));
        $manager->persist($team);

        $team = new Team();
        $team->setName('VSST Günzelhofen');
        $this->addReference('günzelhofen', $team);
        $team->setLeague($this->getReference('kreisliga'));
        $manager->persist($team);

        $team = new Team();
        $team->setName('SC Gröbenzell');
        $this->addReference('gröbenzell', $team);
        $team->setLeague($this->getReference('kreisliga'));
        $manager->persist($team);

        $team = new Team;
        $team->setName('TSV FFB West');
        $this->addReference('ffb_west', $team);
        $team->setLeague($this->getReference('kreisliga'));
        $manager->persist($team);

        $team = new Team;
        $team->setName('SV Mammendorf');
        $this->addReference('mammendorf', $team);
        $team->setLeague($this->getReference('kreisliga'));
        $manager->persist($team);

        $team = new Team;
        $team->setName('SC Oberweikertshofen II');
        $this->addReference('oberweikertshofen', $team);
        $team->setLeague($this->getReference('kreisliga'));
        $manager->persist($team);

        $team = new Team;
        $team->setName('TSV Bernbeuren');
        $this->addReference('bernbeuren', $team);
        $team->setLeague($this->getReference('kreisliga'));
        $manager->persist($team);

        $team = new Team;
        $team->setName('TSV Altenstadt');
        $team->setLeague($this->getReference('kreisliga'));
        $this->addReference('altenstadt', $team);
        $manager->persist($team);
        
        //A-KLASSE
        $team = new Team;
        $team->setName('FC Aich II');
        $team->setLeague($this->getReference('aklasse'));
        $this->addReference('aichII', $team);
        $manager->persist($team);          
        
        $team = new Team;
        $team->setName('FC Penzing II');
        $team->setLeague($this->getReference('aklasse'));
        $this->addReference('penzingII', $team);
        $manager->persist($team);  
        
        $team = new Team;
        $team->setName('SV RW Überacker');
        $team->setLeague($this->getReference('aklasse'));
        $this->addReference('überacker', $team);
        $manager->persist($team); 

        $team = new Team;
        $team->setName('SC Malching');
        $team->setLeague($this->getReference('aklasse'));
        $this->addReference('malching', $team);
        $manager->persist($team); 

        $team = new Team;
        $team->setName('TSV Türkenfeld');
        $team->setLeague($this->getReference('aklasse'));
        $this->addReference('türkenfeld', $team);
        $manager->persist($team); 

        $team = new Team;
        $team->setName('SC Schöngeising');
        $team->setLeague($this->getReference('aklasse'));
        $this->addReference('schöngeising', $team);
        $manager->persist($team); 

        $team = new Team;
        $team->setName('TSV Geltendorf');
        $team->setLeague($this->getReference('aklasse'));
        $this->addReference('geltendorf', $team);
        $manager->persist($team); 

        $team = new Team;
        $team->setName('SV Mammendorf II');
        $team->setLeague($this->getReference('aklasse'));
        $this->addReference('mammendorfII', $team);
        $manager->persist($team); 

        $team = new Team;
        $team->setName('SV Haspelmoor');
        $team->setLeague($this->getReference('aklasse'));
        $this->addReference('haspelmoor', $team);
        $manager->persist($team);         
        
        $team = new Team;
        $team->setName('TSV Jesenwang');
        $team->setLeague($this->getReference('aklasse'));
        $this->addReference('jesenwang', $team);
        $manager->persist($team); 

        $team = new Team;
        $team->setName('TSV Aufkirchen');
        $team->setLeague($this->getReference('aklasse'));
        $this->addReference('aufkirchen', $team);
        $manager->persist($team);
        
        $team = new Team;
        $team->setName('SV Kottgeisering');
        $team->setLeague($this->getReference('aklasse'));
        $this->addReference('kottgeisering', $team);
        $manager->persist($team);        
        
        //BUNDESLIGA
        $team = new Team;
        $team->setName('Borussia Dortmund');
        $team->setLeague($this->getReference('1.bundesliga'));
        $this->addReference('dortmund', $team);
        $manager->persist($team);        

        $team = new Team;
        $team->setName('Eintracht Frankfurt');
        $team->setLeague($this->getReference('1.bundesliga'));
        $this->addReference('frankfurt', $team);
        $manager->persist($team);   
        
        $team = new Team;
        $team->setName('Werder Bremen');
        $team->setLeague($this->getReference('1.bundesliga'));
        $this->addReference('bremen', $team);
        $manager->persist($team);   

        $team = new Team;
        $team->setName('FC Bayern München');
        $team->setLeague($this->getReference('1.bundesliga'));
        $this->addReference('bayern', $team);
        $manager->persist($team);   

        $team = new Team;
        $team->setName('FC Schalke 04');
        $team->setLeague($this->getReference('1.bundesliga'));
        $this->addReference('schalke', $team);
        $manager->persist($team);           

        $team = new Team;
        $team->setName('FC Ingolstadt');
        $team->setLeague($this->getReference('1.bundesliga'));
        $this->addReference('ingolstadt', $team);
        $manager->persist($team);           
        
        $team = new Team;
        $team->setName('Hertha BSC Berlin');
        $team->setLeague($this->getReference('1.bundesliga'));
        $this->addReference('berlin', $team);
        $manager->persist($team);           
        
        $team = new Team;
        $team->setName('Hamburger SV');
        $team->setLeague($this->getReference('1.bundesliga'));
        $this->addReference('hamburg', $team);
        $manager->persist($team);           
        
        $team = new Team;
        $team->setName('1.FC Köln');
        $team->setLeague($this->getReference('1.bundesliga'));
        $this->addReference('köln', $team);
        $manager->persist($team);           
        
        $team = new Team;
        $team->setName('Borussia Mönchengladbach');
        $team->setLeague($this->getReference('1.bundesliga'));
        $this->addReference('gladbach', $team);
        $manager->persist($team);           
        
        $team = new Team;
        $team->setName('FC Augsburg');
        $team->setLeague($this->getReference('1.bundesliga'));
        $this->addReference('augsburg', $team);
        $manager->persist($team);           
        
        $team = new Team;
        $team->setName('TSG 1899 Hoffenheim');
        $team->setLeague($this->getReference('1.bundesliga'));
        $this->addReference('hoffenheim', $team);
        $manager->persist($team);           
        
        $team = new Team;
        $team->setName('Bayer Leverkusen');
        $team->setLeague($this->getReference('1.bundesliga'));
        $this->addReference('leverkusen', $team);
        $manager->persist($team);           
        
        $team = new Team;
        $team->setName('FSV Mainz 05');
        $team->setLeague($this->getReference('1.bundesliga'));
        $this->addReference('mainz', $team);
        $manager->persist($team);           
        
        $team = new Team;
        $team->setName('Vfl Wolfsburg');
        $team->setLeague($this->getReference('1.bundesliga'));
        $this->addReference('wolfsburg', $team);
        $manager->persist($team);           
        
        $team = new Team;
        $team->setName('SV Darmstadt 98');
        $team->setLeague($this->getReference('1.bundesliga'));
        $this->addReference('darmstadt', $team);
        $manager->persist($team);           
        
        $team = new Team;
        $team->setName('RB Leipzig');
        $team->setLeague($this->getReference('1.bundesliga'));
        $this->addReference('leipzig', $team);
        $manager->persist($team);           
        
        $team = new Team;
        $team->setName('SC Freiburg');
        $team->setLeague($this->getReference('1.bundesliga'));
        $this->addReference('freiburg', $team);
        $manager->persist($team);          
        
        //2.Bundesliga
        $team = new Team;
        $team->setName('Hannover 96');
        $team->setLeague($this->getReference('2.bundesliga'));
        $this->addReference('hannover', $team);
        $manager->persist($team);        
        
        $team = new Team;
        $team->setName('Eintracht Braunschweig');
        $team->setLeague($this->getReference('2.bundesliga'));
        $this->addReference('braunschweig', $team);
        $manager->persist($team);        
        
        $team = new Team;
        $team->setName('Fortuna Düsseldorf');
        $team->setLeague($this->getReference('2.bundesliga'));
        $this->addReference('düsseldorf', $team);
        $manager->persist($team);        
        
        $team = new Team;
        $team->setName('Vfl Bochum');
        $team->setLeague($this->getReference('2.bundesliga'));
        $this->addReference('bochum', $team);
        $manager->persist($team);        
        
        $team = new Team;
        $team->setName('1.FC Heidenheim');
        $team->setLeague($this->getReference('2.bundesliga'));
        $this->addReference('heidenheim', $team);
        $manager->persist($team);        
        
        $team = new Team;
        $team->setName('Erzgebirge Aue');
        $team->setLeague($this->getReference('2.bundesliga'));
        $this->addReference('aue', $team);
        $manager->persist($team);        
        
        $team = new Team;
        $team->setName('VfB Stuttgart');
        $team->setLeague($this->getReference('2.bundesliga'));
        $this->addReference('stuttgart', $team);
        $manager->persist($team);        
        
        $team = new Team;
        $team->setName('TSV 1860 München');
        $team->setLeague($this->getReference('2.bundesliga'));
        $this->addReference('münchen', $team);
        $manager->persist($team);        
        
        $team = new Team;
        $team->setName('SpVgg Greuther Fürth');
        $team->setLeague($this->getReference('2.bundesliga'));
        $this->addReference('fürth', $team);
        $manager->persist($team);        
        
        $team = new Team;
        $team->setName('Dynamo Dresden');
        $team->setLeague($this->getReference('2.bundesliga'));
        $this->addReference('dresden', $team);
        $manager->persist($team);        
        
        $team = new Team;
        $team->setName('1.FC Nürnberg');
        $team->setLeague($this->getReference('2.bundesliga'));
        $this->addReference('nürnberg', $team);
        $manager->persist($team);        
        
        $team = new Team;
        $team->setName('Karlsruher SC');
        $team->setLeague($this->getReference('2.bundesliga'));
        $this->addReference('Karlsruhe', $team);
        $manager->persist($team);        
        
        $team = new Team;
        $team->setName('1.FC Union Berlin');
        $team->setLeague($this->getReference('2.bundesliga'));
        $this->addReference('unionberlin', $team);
        $manager->persist($team);        
        
        $team = new Team;
        $team->setName('FC Würzburger Kickers');
        $team->setLeague($this->getReference('2.bundesliga'));
        $this->addReference('würzburg', $team);
        $manager->persist($team);        
        
        $team = new Team;
        $team->setName('Armina Bielefeld');
        $team->setLeague($this->getReference('2.bundesliga'));
        $this->addReference('bielefeld', $team);
        $manager->persist($team);        
        
        $team = new Team;
        $team->setName('SV Sandhausen');
        $team->setLeague($this->getReference('2.bundesliga'));
        $this->addReference('sandhausen', $team);
        $manager->persist($team);        
        
        $team = new Team;
        $team->setName('1.FC Kaiserslautern');
        $team->setLeague($this->getReference('2.bundesliga'));
        $this->addReference('kaiserslautern', $team);
        $manager->persist($team);        
        
        $team = new Team;
        $team->setName('1.FC St.Pauli');
        $team->setLeague($this->getReference('2.bundesliga'));
        $this->addReference('pauli', $team);
        $manager->persist($team);        
        
        //NATIONALMANNSCHAFT
        $team = new Team;
        $team->setName('Deutschland');
        $team->setLeague($this->getReference('nationalmannschaft'));
        $this->addReference('deutschland', $team);
        $manager->persist($team);           

        $team = new Team;
        $team->setName('Tschechische Rep.');
        $team->setLeague($this->getReference('nationalmannschaft'));
        $this->addReference('tschechische', $team);
        $manager->persist($team);       

        $team = new Team;
        $team->setName('Nordirland');
        $team->setLeague($this->getReference('nationalmannschaft'));
        $this->addReference('nordirland', $team);
        $manager->persist($team);       

        $team = new Team;
        $team->setName('San Marino');
        $team->setLeague($this->getReference('nationalmannschaft'));
        $this->addReference('sanmarino', $team);
        $manager->persist($team);       

        $team = new Team;
        $team->setName('Italien');
        $team->setLeague($this->getReference('nationalmannschaft'));
        $this->addReference('italien', $team);
        $manager->persist($team);       

        $team = new Team;
        $team->setName('Aserbaidschan');
        $team->setLeague($this->getReference('nationalmannschaft'));
        $this->addReference('aserbaidschan', $team);
        $manager->persist($team);     
        
        
        $manager->flush();        
    }

    public function getOrder() {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 2;
    }

}
