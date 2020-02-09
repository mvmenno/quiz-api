<?php

namespace App\Repository;

use App\Entity\QuizTriviaMeta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method QuizTriviaMeta|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuizTriviaMeta|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuizTriviaMeta[]    findAll()
 * @method QuizTriviaMeta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizTriviaMetaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuizTriviaMeta::class);
    }
}
