<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuestionRepository")
 */
class Question
{
    
    public function __construct() {
        $this->possibleAnswers = new ArrayCollection();
    }    
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="correct_answer", type="string", length=255, nullable=true)
     */
    private $correctAnswer;

    /**
     * @ORM\ManyToOne(targetEntity="QuestionType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    private $type;    
    
    /**
     * @ORM\OneToMany(targetEntity="PossibleAnswer", mappedBy="question")
     */
    private $possibleAnswers;      

    
    function getPossibleAnswers() {
        return $this->possibleAnswers;
    }

    function setPossibleAnswers($possibleAnswers) {
        $this->possibleAnswers = $possibleAnswers;
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
     * Set question
     *
     * @param string $question
     *
     * @return Question
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set correctAnswer
     *
     * @param string $correctAnswer
     *
     * @return Question
     */
    public function setCorrectAnswer($correctAnswer)
    {
        $this->correctAnswer = $correctAnswer;

        return $this;
    }

    /**
     * Get correctAnswer
     *
     * @return string
     */
    public function getCorrectAnswer()
    {
        return $this->correctAnswer;
    }
    
    /**
     * Set type
     *
     * @param integer $type
     *
     * @return QuestionType
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return QuestionType
     */
    public function getType()
    {
        return $this->type;
    }    
}

