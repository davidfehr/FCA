<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameRepository")
 */
class Game
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="home_team_id", referencedColumnName="id")
     */
    private $homeTeam;

    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="guest_team_id", referencedColumnName="id")
     */
    private $guestTeam;

    /**
     * @var int
     *
     * @ORM\Column(name="homeTeamScore", type="integer", nullable=true)
     */
    private $homeTeamScore;

    /**
     * @var int
     *
     * @ORM\Column(name="guestTeamScore", type="integer", nullable=true)
     */
    private $guestTeamScore;

    /** 
     * @ORM\Column(type="integer", name="match_day", nullable=true) 
     */
    private $matchDay;
    
    /** 
     * @ORM\Column(type="datetime", name="match_at", nullable=true) 
     */
    private $matchDate;    
    
    /**
     * @ORM\ManyToOne(targetEntity="League")
     * @ORM\JoinColumn(name="league_id", referencedColumnName="id")
     */
    private $league;
    
    
    function getLeague() {
        return $this->league;
    }

    function setLeague($league) {
        $this->league = $league;
    }    
    
    function getMatchDay() {
        return $this->matchDay;
    }

    function setMatchDay($matchDay) {
        $this->matchDay = $matchDay;
    }

        
    function getMatchDate() {
        return $this->matchDate;
    }

    function setMatchDate($matchDate) {
        $this->matchDate = $matchDate;
    }
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set homeTeam
     *
     * @param Team $homeTeam
     *
     * @return Game
     */
    public function setHomeTeam($homeTeam)
    {
        $this->homeTeam = $homeTeam;

        return $this;
    }

    /**
     * Get homeTeam
     *
     * @return Team
     */
    public function getHomeTeam()
    {
        return $this->homeTeam;
    }

    /**
     * Set guestTeam
     *
     * @param Team $guestTeam
     *
     * @return Team
     */
    public function setGuestTeam($guestTeam)
    {
        $this->guestTeam = $guestTeam;

        return $this;
    }

    /**
     * Get guestTeam
     *
     * @return Team
     */
    public function getGuestTeam()
    {
        return $this->guestTeam;
    }

    /**
     * Set homeTeamScore
     *
     * @param integer $homeTeamScore
     *
     * @return Game
     */
    public function setHomeTeamScore($homeTeamScore)
    {
        $this->homeTeamScore = $homeTeamScore;

        return $this;
    }

    /**
     * Get homeTeamScore
     *
     * @return int
     */
    public function getHomeTeamScore()
    {
        return $this->homeTeamScore;
    }

    /**
     * Set guestTeamScore
     *
     * @param integer $guestTeamScore
     *
     * @return Game
     */
    public function setGuestTeamScore($guestTeamScore)
    {
        $this->guestTeamScore = $guestTeamScore;

        return $this;
    }

    /**
     * Get guestTeamScore
     *
     * @return int
     */
    public function getGuestTeamScore()
    {
        return $this->guestTeamScore;
    }
}

