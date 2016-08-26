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
     * @var int
     *
     * @ORM\Column(name="userId", type="integer")
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="gameId", type="integer")
     */
    private $gameId;

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
     * Set userId
     *
     * @param integer $userId
     *
     * @return Bet
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set gameId
     *
     * @param integer $gameId
     *
     * @return Bet
     */
    public function setGameId($gameId)
    {
        $this->gameId = $gameId;

        return $this;
    }

    /**
     * Get gameId
     *
     * @return int
     */
    public function getGameId()
    {
        return $this->gameId;
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

