<?php

declare(strict_types=1);

namespace App\Application\PassTest\FormData;

use App\Infrastructure\Entity\Answer;
use App\Infrastructure\Entity\Question;
use App\Infrastructure\Repository\AnswerRepository;

class CollectService implements CollectServiceInterface
{
    /**
     * @var Answer[]|array
     */
    public array $answers = [];

    /**
     * @var array|Question[]
     */
    public array $questions = [];

    /**
     * @var array<int, array<int, Answer>>
     */
    public array $choices;

    public function __construct(
        private readonly AnswerRepository $answerRepository
    ) {
        $this->answers = $this->answerRepository->findAllWithQuestions();
    }

    public function handle(): void
    {
        foreach ($this->answers as $answer) {
            $question = $answer->getQuestion();
            $this->addQuestion($question);
            $this->addChoice($question->getId(), $answer);
        }
    }

    public function getQuestions(): array
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): void
    {
        if (!isset($this->questions[$question->getId()])) {
            $this->questions[$question->getId()] = $question;
        }
    }

    public function addChoice(int $questionId, Answer $answer): void
    {
        $this->choices[$questionId][] = $answer;
    }

    /**
     * @return Answer[][]
     */
    public function getChoices(): array
    {
        return $this->choices;
    }
}
