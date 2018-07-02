<?php

namespace App\Repository;

use App\Entity\CatShop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CatShop|null find($id, $lockMode = null, $lockVersion = null)
 * @method CatShop|null findOneBy(array $criteria, array $orderBy = null)
 * @method CatShop[]    findAll()
 * @method CatShop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatShopRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CatShop::class);
    }

//    /**
//     * @return CatShop[] Returns an array of CatShop objects
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
    public function findOneBySomeField($value): ?CatShop
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
