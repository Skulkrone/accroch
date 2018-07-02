<?php

namespace App\Repository;

use App\Entity\CatAdd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CatAdd|null find($id, $lockMode = null, $lockVersion = null)
 * @method CatAdd|null findOneBy(array $criteria, array $orderBy = null)
 * @method CatAdd[]    findAll()
 * @method CatAdd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatAddRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CatAdd::class);
    }

//    /**
//     * @return CatAdd[] Returns an array of CatAdd objects
//     */
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
    public function findOneBySomeField($value): ?CatAdd
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
