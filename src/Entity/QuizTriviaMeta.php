<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuizTriviaMetaRepository")
 */
class QuizTriviaMeta
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\QuizTrivia") 
     * @ORM\JoinColumn(nullable=false,name="quiz_trivia_id",referencedColumnName="id")
     */
    private $quiz_trivia_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_answer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuizTriviaId(): ?QuizTrivia
    {
        return $this->quiz_trivia_id;
    }

    public function setQuizTriviaId(?QuizTrivia $quiz_trivia_id): self
    {
        $this->quiz_trivia_id = $quiz_trivia_id;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getIsAnswer(): ?bool
    {
        return $this->is_answer;
    }

    public function setIsAnswer(bool $is_answer): self
    {
        $this->is_answer = $is_answer;

        return $this;
    }
}
