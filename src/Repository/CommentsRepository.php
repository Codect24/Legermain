<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\Comments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comments|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comments|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comments[]    findAll()
 * @method Comments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentsRepository extends ServiceEntityRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Comments::class);
	}

	public function findJoinUserByArticle(Article $article)
	{

		return $this->createQueryBuilder('c')
			->addSelect('u')
			->innerJoin('c.user', 'u')
			->where('c.article = :article')
			->setParameter('article', $article)
			->orderBy('c.publicationDate', 'DESC')
			->getQuery()
			->getResult()
			;

	}

	/*
	public function findOneBySomeField($value): ?Comments
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
