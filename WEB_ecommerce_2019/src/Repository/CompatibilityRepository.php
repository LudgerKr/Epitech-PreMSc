<?php

namespace App\Repository;

use App\Entity\Compatibility;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Compatibility|null find($id, $lockMode = null, $lockVersion = null)
 * @method Compatibility|null findOneBy(array $criteria, array $orderBy = null)
 * @method Compatibility[]    findAll()
 * @method Compatibility[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompatibilityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Compatibility::class);
    }

    // /**
    //  * @return Compatibility[] Returns an array of Compatibility objects
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
    public function findOneBySomeField($value): ?Compatibility
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
