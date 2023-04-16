<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuestionQuiz
 *
 * @ORM\Table(name="question_quiz")
 * @ORM\Entity
 */
class QuestionQuiz
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_quest", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $idQuest;

    /**
     * @var string
     *
     * @ORM\Column(name="desc_question", type="string", length=200, nullable=false)
     */
    private $descQuestion;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="App\Entity\Quiz", inversedBy="QuestionQuiz")
     * @ORM\Column(name="idQuiz", type="integer", nullable=true)

     */
    private $idQuiz;

    public function getIdQuest(): ?int
    {
        return $this->idQuest;
    }

    public function getDescQuestion(): ?string
    {
        return $this->descQuestion;
    }

    public function setDescQuestion(string $descQuestion): self
    {
        $this->descQuestion = $descQuestion;

        return $this;
    }

    public function getIdQuiz(): ?int
    {
        return $this->idQuiz;
    }

    public function setIdQuiz(?int $idQuiz): self
    {
        $this->idQuiz = $idQuiz;

        return $this;
    }


}
