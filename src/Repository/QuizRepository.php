<?php

namespace App\Repository;

use App\Entity\Quiz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Quiz|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quiz|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quiz[]    findAll()
 * @method Quiz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quiz::class);
    }
    /**
     * 
     * @param App\Repository\UserRepository $user
     * @return array
     */
    public function findByUser($user)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.user = :val')
            ->setParameter('val', $user)
            ->orderBy('q.created_at', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getArrayResult();
    }
}
