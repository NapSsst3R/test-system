<?php
declare(strict_types=1);

namespace App\Infrastructure\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpKernel\KernelInterface;
use App\Infrastructure\Entity\Question;
use App\Infrastructure\Entity\Answer;

class AppFixtures extends Fixture
{
    private $data = null;

    public function __construct(
        private readonly KernelInterface $appKernel
    ) {
        $filePath = $this->appKernel->getProjectDir() . '/.docker/db/fixtures/questions.json';
        $this->data = json_decode(file_get_contents($filePath), true);
    }

    public function load(ObjectManager $manager): void
    {
        foreach ($this->data as $item) {
            $question = (new Question())->setTitle($item['title']);
            foreach ($item['answers'] as $answerItem) {
                $answer = (new Answer())->setTitle($answerItem['title'])->setCorrect($answerItem['correct']);
                $question->addAnswer($answer);
            }
            $manager->persist($question);
        }

        $manager->flush();
    }
}
