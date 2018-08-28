<?php

namespace App\Repository;

use App\Entity\Messages;
use App\Entity\Announcements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Messages|null find($id, $lockMode = null, $lockVersion = null)
 * @method Messages|null findOneBy(array $criteria, array $orderBy = null)
 * @method Messages[]    findAll()
 * @method Messages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessagesRepository extends ServiceEntityRepository {

    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, Messages::class);
    }

    public function messagesSQL() {

        $bdd = new \PDO('mysql:host=localhost;dbname=accroch;charset=utf8', 'root', '', array(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION));
        $req = $bdd->prepare('SELECT username, id FROM user ORDER BY id ASC');
        $req->execute();

        $i = 0;
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
            $userId[$i] = $data;
            $i++;
        }
        return $userId;
    }

    

    /* public function findByWithAuthor() {
      return $this->createQueryBuilder('a')
      ->leftJoin('a.fkToUserId', 'us')
      ->where('a.fkToUserId = us.fkUserId')
      ->addSelect('us')
      //->groupBy('')
      ->orderBy('a.fkToUserId', 'ASC')
      //->andOrderBy('z.blogId', 'ASC')
      ->getQuery()
      ->getSQL()
      //->getResult()
      ;
      } */

//    /**
//     * @return Messages[] Returns an array of Messages objects
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

    /* public function findByWithMessages($id) {
      return $this->createQueryBuilder('m')
      ->leftJoin('m.fkToUserId', 'ms')
      ->where('m.fkarticles = :id')->setParameter('id', $id)
      ->addSelect('ms')
      //->orderBy('a.fkarticle', 'ASC')
      ->getQuery()
      //->getSQL()
      ->getResult()
      ;
      } */
}
