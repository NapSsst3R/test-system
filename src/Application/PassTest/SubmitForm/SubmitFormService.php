<?php

declare(strict_types=1);

namespace App\Application\PassTest\SubmitForm;

use App\Infrastructure\Entity\Answer;
use App\Infrastructure\Entity\Test;
use App\Infrastructure\Entity\TestAnswers;
use App\Infrastructure\Repository\TestRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class SubmitFormService implements SubmitFormServiceInterface
{
    public function __construct(
        private readonly TestRepository $testRepository,
        private readonly RequestStack $requestStack,
    ) {}

    public function handle(array $data, array $questions): Test
    {
        $sessionId = $this->requestStack->getSession()->getId();
        $test = (new Test())->setSessionId($sessionId)->setFinish(true);

        /**
         * @var int $questionId
         * @var Answer[]|array $answers
         */
        foreach ($data as $questionId => $answers) {
            $hasWrongAnswer = array_filter($answers, function (Answer $item) {
                return !$item->isCorrect();
            });

            $testAnswer = (new TestAnswers())
                ->setQuestion($questions[$questionId])
                ->setTest($test)
                ->setCorrect(empty($hasWrongAnswer));

            $test->addTestAnswer($testAnswer);
        }

        $this->testRepository->save($test, true);

        return $test;
    }
}
