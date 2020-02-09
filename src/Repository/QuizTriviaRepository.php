<?php

namespace App\Repository;

use App\Entity\QuizTrivia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method QuizTrivia|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuizTrivia|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuizTrivia[]    findAll()
 * @method QuizTrivia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizTriviaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuizTrivia::class);
    }

    // /**
    //  * @return QuizTrivia[] Returns an array of QuizTrivia objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuizTrivia
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
