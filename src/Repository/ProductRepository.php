<?php

namespace App\Repository;

use App\Data\RechercheCriteria;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @return Product[] Returns an array of Product object
     */
    public function findProductsFiltered(RechercheCriteria $criteria){

        $qb = $this->createQueryBuilder('p');
        if($criteria->getSearch() != ""){
            $qb->andWhere($qb->expr()->like('p.title', ':title'))
                ->setParameter('title', "%".$criteria->getSearch()."%");
        }
        if($criteria->getColour() != null){
            $qb->andWhere("p.colour = :colour")
                ->setParameter('site', $criteria->getColour());
        }
        if($criteria->getBrand() != null){
            $qb->andWhere("p.brand = :brand")
                ->setParameter('brand', $criteria->getBrand());
        }
        if($criteria->getRegion() != "all"){
            $qb->andWhere("p.region = :region")
                ->setParameter('region', $criteria->getRegion());
        }
        if($criteria->getDepartement() != "all"){
            $qb->andWhere("p.departement = :departement")
                ->setParameter('departement', $criteria->getDepartement());
        }
        if($criteria->isInterieure()){
            $qb->andWhere("p.category = :category")
                ->setParameter("category", "p.category LIKE 'Peinture intérieure'");
        }
        if($criteria->isExterieure()){
            $qb->andWhere("p.category = :category")
                ->setParameter("category", "p.category LIKE 'Peinture extérieure'");
        }
        if($criteria->isOutils()){
            $qb->andWhere("p.category = :category")
                ->setParameter("category", "p.category LIKE 'Outils du peintre'");
        }
        $qb->join("p.colour", "co");
        $qb->join("p.category", 'ca');
        $qb->join("p.brand", "b");
        $qb->Select("p.id ,p.title, p.");
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
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
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
