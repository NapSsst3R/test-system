<?php

declare(strict_types=1);

namespace App\Application\PassTest\SubmitForm;

use App\Infrastructure\Entity\Test;

interface SubmitFormServiceInterface
{
    /**
     * @param array $data
     * @param array $questions
     *
     * @return Test
     */
    public function handle(array $data, array $questions): Test;
}
