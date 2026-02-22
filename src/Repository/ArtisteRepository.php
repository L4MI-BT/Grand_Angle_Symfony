<?php

namespace App\Repository;

use App\Entity\Artiste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Artiste>
 */
class ArtisteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artiste::class);
    }

        /**
     * Récupérer un artiste avec toutes ses œuvres
     * 
     * @param int $id
     * @return Artiste|null
     */
    public function findWithOeuvres(int $id): ?Artiste
    {
        return $this->createQueryBuilder('a')
            ->leftJoin('a.oeuvres', 'o')
            ->addSelect('o')
            ->where('a.id = :id')
            ->setParameter('id', $id)
            ->orderBy('o.anneeCreation', 'DESC')
            ->getQuery()
            ->getOneOrNullResult();
    }

//    /**
//     * @return Artiste[] Returns an array of Artiste objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Artiste
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
