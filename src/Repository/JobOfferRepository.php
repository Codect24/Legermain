<?php

namespace App\Repository;

use App\Entity\JobOffer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method JobOffer|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobOffer|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobOffer[]    findAll()
 * @method JobOffer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobOfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobOffer::class);
    }

//    Return a function with a matching title
    public function findAllByTitle(string $title, string $style, string $type): array{
        $entityManager = $this->getEntityManager();
        if($style == 1 || $style == 2) {
            $query = $entityManager->createQuery('SELECT j FROM App\Entity\JobOffer j WHERE j.jobStyle = :style AND j.jobType = :type AND j.title LIKE :title')->setParameters(array(
                'style' => $style,
                'type' => $type,
                'title' => '%' . $title . '%'
            ));
        }
        elseif ($style == 0) {
            $query = $entityManager->createQuery('SELECT j FROM App\Entity\JobOffer j WHERE j.jobType = :type AND j.title LIKE :title')->setParameters(array(
                'type' => $type,
                'title' => '%' . $title . '%'
            ));
        }
        else {
            $query = $entityManager->createQuery('SELECT j FROM App\Entity\JobOffer j WHERE j.title LIKE :title')->setParameters(array(
                'title' => '%' . $title . '%'
            ));
        }

        return $query->getResult();
    }

    // /**
    //  * @return JobOffer[] Returns an array of JobOffer objects
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
    public function findOneBySomeField($value): ?JobOffer
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
