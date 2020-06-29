<?php

namespace App\Repository;

use App\Entity\MethodPaymentType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MethodPaymentType|null find($id, $lockMode = null, $lockVersion = null)
 * @method MethodPaymentType|null findOneBy(array $criteria, array $orderBy = null)
 * @method MethodPaymentType[]    findAll()
 * @method MethodPaymentType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MethodPaymentTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MethodPaymentType::class);
    }

    // /**
    //  * @return MethodPaymentType[] Returns an array of MethodPaymentType objects
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
    public function findOneBySomeField($value): ?MethodPaymentType
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
