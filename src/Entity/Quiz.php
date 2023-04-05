<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;


use Doctrine\ORM\Mapping as ORM;

/**
 * quiz
 *
 * @ORM\Table(name="quiz")
 * @ORM\Entity
 */
class Quiz
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_quiz", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $idQuiz;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=100, nullable=false)
    #[Assert\NotBlank(message:"Le titre est obligatoire")]
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="option1", type="string", length=100, nullable=false)
    #[Assert\NotBlank(message:"Choisissez une option")]
     */
    private $option1;

    /**
     * @var string
     *
     * @ORM\Column(name="option2", type="string", length=100, nullable=false)
    #[Assert\NotBlank(message:"Choisissez une option")]
     */
    private $option2;

    /**
     * @var string
     *
     * @ORM\Column(name="option3", type="string", length=100, nullable=false)
    #[Assert\NotBlank(message:"Choisissez une option")]
     */
    private $option3;

    /**
     * @var string
     *
     * @ORM\Column(name="option4", type="string", length=100, nullable=false)
    #[Assert\NotBlank(message:"Choisissez une option")]
     */
    private $option4;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=100, nullable=false)
    #[Assert\NotBlank(message:"Entrer une question")]
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="reponse_correcte", type="string", length=100, nullable=false)
    #[Assert\NotBlank(message:"Entrer la reponse correcte ")]
     */
    private $reponseCorrecte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Admin", inversedBy="quiz")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })

     */
    private $admin;

    public function getIdQuiz(): ?int
    {
        return $this->idQuiz;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
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

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

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

    public function getId(): ?Admin
    {
        return $this->id;
    }

    public function setId(?Admin $id): self
    {
        $this->id = $id;

        return $this;
    }
    public function getQuiz(): ?string
    {
        return $this->quiz;
    }

    public function setQuiz(string $quiz): self
    {
        $this->quiz = $quiz;

        return $this;
    }
    public function getAdmin(): ?Admin
    {
        return $this->admin;
    }

    public function setAdmin(?Admin $admin): self
    {
        $this->admin = $admin;

        return $this;
    }

}