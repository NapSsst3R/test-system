<?php

namespace App\Infrastructure\Repository;

use App\Infrastructure\Entity\TestAnswers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TestAnswers>
 *
 * @method TestAnswers|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestAnswers|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestAnswers[]    findAll()
 * @method TestAnswers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestAnswersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestAnswers::class);
    }

    /**
     * @return TestAnswers[] Returns an array of TestAnswers objects
     */
    public function findAllByTestId(int $testId): array
    {
        return $this->createQueryBuilder('testAnswer')
            ->innerJoin('testAnswer.question', 'q')
            ->addSelect('q')
            ->andWhere('testAnswer.test = :testId')
            ->setParameter('testId', $testId)
            ->getQuery()
            ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?TestAnswers
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
