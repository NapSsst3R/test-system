<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Infrastructure\Entity\Answer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Answer>
 *
 * @method null|Answer find($id, $lockMode = null, $lockVersion = null)
 * @method null|Answer findOneBy(array $criteria, array $orderBy = null)
 * @method Answer[] findAll()
 * @method Answer[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Answer::class);
    }

    /**
     * @return Answer[] Returns an array of Answer objects
     */
    public function findAllWithQuestions(): array
    {
        return $this->createQueryBuilder('answer')
            ->innerJoin('answer.question', 'question')
            ->addSelect('question')
            ->getQuery()
            ->getResult();
    }
}
