<?php

declare(strict_types=1);

namespace App\Application\ResultTest;

interface ResultTestServiceInterface
{
    /**
     * @param int $testId
     * @param string $sessionId
     *
     * @return array<string, array<string, string|array<string, string|int|bool>>>
     */
    public function getResultInfo(int $testId, string $sessionId): array;
}