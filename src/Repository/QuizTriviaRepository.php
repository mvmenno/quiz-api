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
}
