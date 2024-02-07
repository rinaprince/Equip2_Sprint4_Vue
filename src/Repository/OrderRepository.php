<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Order>
 *
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function findByText(string $value): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('p.state LIKE :val')
            ->setParameter('val', "%$value%")
            ->orderBy('o.state', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }


    /**
     * @param string $value
     * @return Query
     */
    public function findByTextQuery(string $value): Query
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state LIKE :val')
            ->setParameter('val', "%$value%")
            ->orderBy('o.state', 'DESC')
            ->getQuery()
            ;
    }

    /**
     * @param string $value
     * @return Query
     */
    public function findAllQuery(): Query
    {
        return $this->createQueryBuilder('o')
            ->orderBy('o.state', 'DESC')
            ->getQuery()
            ;
    }

//    /**
//     * @return Order[] Returns an array of Order objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Order
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
