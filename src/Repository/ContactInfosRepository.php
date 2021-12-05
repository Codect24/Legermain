<?php

namespace App\Repository;

use App\Entity\ContactInfos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContactInfos|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactInfos|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactInfos[]    findAll()
 * @method ContactInfos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactInfosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactInfos::class);
    }

    // /**
    //  * @return ContactInfos[] Returns an array of ContactInfos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContactInfos
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
