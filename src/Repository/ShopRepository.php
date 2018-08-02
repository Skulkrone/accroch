<?php

namespace App\Repository;

use App\Entity\Shop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Shop|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shop|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shop[]    findAll()
 * @method Shop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShopRepository extends ServiceEntityRepository {

    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, Shop::class);
    }

//    /**
//     * @return Shop[] Returns an array of Shop objects
//     */
    /*
      public function findByExampleField($value)
      {
      return $this->createQueryBuilder('s')
      ->andWhere('s.exampleField = :val')
      ->setParameter('val', $value)
      ->orderBy('s.id', 'ASC')
      ->setMaxResults(10)
      ->getQuery()
      ->getResult()
      ;
      }
     */

    /*
      :
      {
      return $this->createQueryBuilder('s')
      ->andWhere('s.exampleField = :val')
      ->setParameter('val', $value)
      ->getQuery()
      ->getOneOrNullResult()
      ;
      }
     */
    
    /**
     * 
     * Connexion à la base de données en PDO et requête pour afficher la boutique.
     */
    public function exampleSQL() {

        $bdd = new \PDO('mysql:host=localhost;dbname=accroch;charset=utf8', 'root', '', array(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION));
        $req = $bdd->prepare('SELECT shop.label, shop.shop_image, shop.id, shop.logo, cat_shop.label as catshoplabel,
                products.label as productslabel, products.price, products.id as productsid, cat_shop.id, user.id
                FROM shop 
                LEFT JOIN cat_shop ON cat_shop.fk_shop_id_id = shop.id
                LEFT JOIN products ON products.fk_cat_shop_id_id = cat_shop.id
                LEFT JOIN user ON user.id = shop.fk_user_id_id
                WHERE shop.id = 3
                ');              
        $req->execute();

        $i = 0;
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
            $shop[$i] = $data;
            $i++;
        }
        return $shop;
    }

}
