<?php

namespace App\Repository;

use App\Entity\MethodPayment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MethodPayment|null find($id, $lockMode = null, $lockVersion = null)
 * @method MethodPayment|null findOneBy(array $criteria, array $orderBy = null)
 * @method MethodPayment[]    findAll()
 * @method MethodPayment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MethodPaymentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MethodPayment::class);
    }

    // /**
    //  * @return MethodPayment[] Returns an array of MethodPayment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MethodPayment
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
