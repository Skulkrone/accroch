<?php

namespace App\Repository;

use App\Entity\Marketers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Marketers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Marketers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Marketers[]    findAll()
 * @method Marketers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarketersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Marketers::class);
    }

//    /**
//     * @return Marketers[] Returns an array of Marketers objects
//     */
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
    public function findOneBySomeField($value): ?Marketers
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
