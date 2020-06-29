<?php

namespace App\Repository;

use App\Entity\ArticlePurpose;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ArticlePurpose|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticlePurpose|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticlePurpose[]    findAll()
 * @method ArticlePurpose[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlePurposeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticlePurpose::class);
    }

    // /**
    //  * @return ArticlePurpose[] Returns an array of ArticlePurpose objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ArticlePurpose
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
