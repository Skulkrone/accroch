<?php

namespace App\Repository;

use App\Entity\Messages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use PDO;

/**
 * @method Messages|null find($id, $lockMode = null, $lockVersion = null)
 * @method Messages|null findOneBy(array $criteria, array $orderBy = null)
 * @method Messages[]    findAll()
 * @method Messages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessagesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Messages::class);
    }

//    /**
//     * @return Messages[] Returns an array of Messages objects
//     */
    
    public function findByUsername()
    {
                $bdd = new PDO('mysql:host=localhost;dbname=accroch;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION));
                $req = $bdd->prepare('SELECT username FROM user');
                $req->execute();
                
                
                $i = 0;
                while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                    $user[$i] = $data;
                    $i++;
                }
                return $user;
    }
    

    /*
    public function findOneBySomeField($value): ?Messages
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
