<?php

namespace App\Repository;

use App\Entity\Wish;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Wish|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wish|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wish[]    findAll()
 * @method Wish[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WishRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wish::class);
    }


    public function findCategorizedWishes() //: array
    {
        // Requete en mode chaine DQL, on selectionne les wish et les catégories
        //on fait la jointure sur la propriété de la classe
        //on pense à préfixer par l'alias de la table
//        $dql = "SELECT w
//                FROM App\Entity\Wish w, c
//                JOIN w.category c
//                WHERE w.isPublished = 1 :publishStatus
//                ORDER BY w.dateCreated DESC";
//
//        $query = $this->getEntityManager()->createQuery($dql);
        //$query->setParameter("publishStatus", 1);


        $queryBuilder = $this->createQueryBuilder('w');
        $queryBuilder->addOrderBy('w.dateCreated','DESC');
        $queryBuilder
            ->andWhere('w.isPublished = :publishStatus')
            ->join('w.category','c')
            ->addSelect('c')
            ->setMaxResults(30);

        $queryBuilder->setParameter("publishStatus", 1);


        $query = $queryBuilder->getQuery();
        //$query->setMaxResults(30); obligation de faire cette méthode avec le dql

        //Récupère tous les résultats
        $wishes = $query->getResult();

        //Si on a des problème de limit avec des jointures...
//        $paginator = new Paginator($query);
//        return $paginator;

        return $wishes;
    }

    // /**
    //  * @return Wish[] Returns an array of Wish objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Wish
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
