<?php

declare(strict_types=1);

namespace App\Application\PassTest\SubmitForm;

use App\Infrastructure\Entity\Answer;
use App\Infrastructure\Entity\Question;
use App\Infrastructure\Entity\Test;

interface SubmitFormServiceInterface
{
    /**
     * @param Answer[]|array $data
     * @param array|Question[] $questions
     */
    public function handle(array $data, array $questions): Test;
}
