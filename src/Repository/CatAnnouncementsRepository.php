<?php

namespace App\Repository;

use App\Entity\CatAnnouncements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CatAnnouncements|null find($id, $lockMode = null, $lockVersion = null)
 * @method CatAnnouncements|null findOneBy(array $criteria, array $orderBy = null)
 * @method CatAnnouncements[]    findAll()
 * @method CatAnnouncements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatAnnouncementsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CatAnnouncements::class);
    }

//    /**
//     * @return CatAnnouncements[] Returns an array of CatAnnouncements objects
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
    public function findOneBySomeField($value): ?CatAnnouncements
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
