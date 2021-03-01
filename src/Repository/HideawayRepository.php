<?php

namespace App\Repository;

use App\Entity\Hideaway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Hideaway|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hideaway|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hideaway[]    findAll()
 * @method Hideaway[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HideawayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hideaway::class);
    }

    // /**
    //  * @return Hideaway[] Returns an array of Hideaway objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Hideaway
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
