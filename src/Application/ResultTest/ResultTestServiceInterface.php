<?php

declare(strict_types=1);

namespace App\Application\ResultTest;

use App\Infrastructure\Entity\Test;
use App\Infrastructure\Entity\TestAnswers;

interface ResultTestServiceInterface
{
    /**
     * @return array<string, array<string, array<int, TestAnswers>>|Test>
     */
    public function getResultInfo(int $testId, string $sessionId): array;
}
