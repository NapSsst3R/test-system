<?php

declare(strict_types=1);

namespace App\Application\PassTest\FormData;

use App\Infrastructure\Entity\Answer;
use App\Infrastructure\Entity\Question;

interface CollectServiceInterface
{
    public function handle(): void;

    /**
     * @return array|Question[]
     */
    public function getQuestions(): array;

    /**
     * @return Answer[][]|array
     */
    public function getChoices(): array;
}
