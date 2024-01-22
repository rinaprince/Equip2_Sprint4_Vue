<?php

namespace App\Repository;

use App\Entity\PrivateCustomer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PrivateCustomer>
 *
 * @method PrivateCustomer|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrivateCustomer|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrivateCustomer[]    findAll()
 * @method PrivateCustomer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrivateCustomerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrivateCustomer::class);
    }

//    /**
//     * @return PrivateCustomer[] Returns an array of PrivateCustomer objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PrivateCustomer
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
