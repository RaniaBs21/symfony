<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReponseQuiz
 *
 * @ORM\Table(name="reponse_quiz", indexes={@ORM\Index(name="idquestion", columns={"id_quest"})})
 * @ORM\Entity
 */
class ReponseQuiz
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_rep", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRep;

    /**
     * @var string
     *
     * @ORM\Column(name="option1", type="string", length=100, nullable=false)
     */
    private $option1;

    /**
     * @var string
     *
     * @ORM\Column(name="option2", type="string", length=100, nullable=false)
     */
    private $option2;

    /**
     * @var string
     *
     * @ORM\Column(name="option3", type="string", length=100, nullable=false)
     */
    private $option3;

    /**
     * @var string
     *
     * @ORM\Column(name="option4", type="string", length=100, nullable=false)
     */
    private $option4;

    /**
     * @var string
     *
     * @ORM\Column(name="reponse_correcte", type="string", length=100, nullable=false)
     */
    private $reponseCorrecte;

    /**
     * @var \QuestionQuiz
     *
     * @ORM\ManyToOne(targetEntity="QuestionQuiz")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_quest", referencedColumnName="id_quest")
     * })
     */
    private $idQuest;

    public function getIdRep(): ?int
    {
        return $this->idRep;
    }

    public function getOption1(): ?string
    {
        return $this->option1;
    }

    public function setOption1(string $option1): self
    {
        $this->option1 = $option1;

        return $this;
    }

    public function getOption2(): ?string
    {
        return $this->option2;
    }

    public function setOption2(string $option2): self
    {
        $this->option2 = $option2;

        return $this;
    }

    public function getOption3(): ?string
    {
        return $this->option3;
    }

    public function setOption3(string $option3): self
    {
        $this->option3 = $option3;

        return $this;
    }

    public function getOption4(): ?string
    {
        return $this->option4;
    }

    public function setOption4(string $option4): self
    {
        $this->option4 = $option4;

        return $this;
    }

    public function getReponseCorrecte(): ?string
    {
        return $this->reponseCorrecte;
    }

    public function setReponseCorrecte(string $reponseCorrecte): self
    {
        $this->reponseCorrecte = $reponseCorrecte;

        return $this;
    }

    public function getIdQuest(): ?QuestionQuiz
    {
        return $this->idQuest;
    }

    public function setIdQuest(?QuestionQuiz $idQuest): self
    {
        $this->idQuest = $idQuest;

        return $this;
    }


}
