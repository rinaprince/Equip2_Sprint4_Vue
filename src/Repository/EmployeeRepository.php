<?php

namespace App\Repository;

use App\Entity\Employee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Employee>
 *
 * @method Employee|null find($id, $lockMode = null, $lockVersion = null)
 * @method Employee|null findOneBy(array $criteria, array $orderBy = null)
 * @method Employee[]    findAll()
 * @method Employee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployeeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Employee::class);
    }

    /**
     * @return Employee[] Returns an array of Employee objects
     */
    public function findByText($value): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.name LIKE :val')
            ->orWhere('e.lastname LIKE :val')
            ->orWhere('e.type LIKE :val')
            ->setParameter('val', "%$value%")
            ->orderBy('e.name', 'DESC')
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
        return $this->createQueryBuilder('e')
            ->andWhere('e.content LIKE :val')
            ->setParameter('val', $value)
            ->orderBy('e.name', 'DESC')
            ->getQuery()
        ;
    }

    /**
     * @param string $value
     * @return Query
     */

    public function findAllQuery(): Query
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.name', 'DESC')
            ->getQuery()
            ;
    }
}
