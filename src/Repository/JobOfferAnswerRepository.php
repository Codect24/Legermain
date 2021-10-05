<?php

namespace App\Repository;

use App\Entity\JobOfferAnswer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method JobOfferAnswer|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobOfferAnswer|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobOfferAnswer[]    findAll()
 * @method JobOfferAnswer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobOfferAnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobOfferAnswer::class);
    }

    // /**
    //  * @return JobOfferAnswer[] Returns an array of JobOfferAnswer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JobOfferAnswer
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
