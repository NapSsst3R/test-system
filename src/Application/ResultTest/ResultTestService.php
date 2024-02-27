<?php

declare(strict_types=1);

namespace App\Application\ResultTest;

use App\Infrastructure\Repository\TestRepository;
use App\Infrastructure\Repository\TestAnswersRepository;

class ResultTestService implements ResultTestServiceInterface
{
    public function __construct(
        private readonly TestRepository $testRepository,
        private readonly TestAnswersRepository $testAnswerRepository,
    )
    {
    }

    public function getResultInfo(int $testId, string $sessionId): array
    {
        $test = $this->testRepository->findOneBy(['id' => $testId, 'session_id' => $sessionId]);

        if (!$test) {
            // @todo throw Exception
            return [];
        }

        $correct = [];
        $inCorrect = [];

        $answers = $this->testAnswerRepository->findAllByTestId($testId);
        foreach ($answers as $answer) {
            if ($answer->isCorrect()) {
                $correct[] = $answer;
            } else {
                $inCorrect[] = $answer;
            }
        }

        return [
            'test' => $test,
            'answers' => [
                'correct' => $correct,
                'inCorrect' => $inCorrect
            ]
        ];
    }
}