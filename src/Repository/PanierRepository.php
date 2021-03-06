<?php

namespace App\Repository;

use App\Entity\Panier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Panier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Panier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Panier[]    findAll()
 * @method Panier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PanierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Panier::class);
    }

    /**
     * @param $id
     * @return int|mixed|string
     */
    public function fingAllPanier($id)
    {

        return $this->createQueryBuilder("p")
            ->join("p.account","a")
            ->leftJoin("p.cats","c")
            ->andWhere("a.id = :id")
            ->setParameter('id',$id)
            ->getQuery()
            ->getOneOrNullResult();

        /*$em = $this->getEntityManager();

        $dql = "select c from App\Entity\Panier p join App\Entity\Account a on a.id = p.account join App\Entity\Cat c on c.panier = p.id WHERE a.id = :id";

        $query = $em->createQuery($dql)->setParameter('id', $id);

        return $query->getResult();*/

    }



    // /**
    //  * @return Panier[] Returns an array of Panier objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Panier
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
