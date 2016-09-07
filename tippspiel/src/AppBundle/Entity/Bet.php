<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bet
 *
 * @ORM\Table(name="bet")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BetRepository")
 */
class Bet
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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user;

    /**
     * @var Game
     *
     * @ORM\ManyToOne(targetEntity="Game")
     */
    private $game;

    /**
     * @var int
     *
     * @ORM\Column(name="homeTeamScore", type="integer")
     */
    private $homeTeamScore;

    /**
     * @var int
     *
     * @ORM\Column(name="guestTeamScore", type="integer")
     */
    private $guestTeamScore;


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
     * Set user
     *
     * @param User $user
     *
     * @return Bet
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set game
     *
     * @param Game $game
     *
     * @return Bet
     */
    public function setGame($game)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return Game
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Set homeTeamScore
     *
     * @param integer $homeTeamScore
     *
     * @return Bet
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
     * @return Bet
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

