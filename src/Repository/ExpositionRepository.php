<?php

namespace App\Repository;

use App\Entity\Exposition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Exposition>
 */
class ExpositionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exposition::class);
    }

        /**
     * Récupérer l'exposition actuellement en cours
     * 
     * @return Exposition|null
     */
    public function findCurrent(): ?Exposition
    {
        $today = new \DateTime();
        
        return $this->createQueryBuilder('e')
            ->where('e.dateDebut <= :today')
            ->andWhere('e.dateFin >= :today')
            ->andWhere('e.modulePublicActif = :actif')
            ->setParameter('today', $today)
            ->setParameter('actif', true)
            ->orderBy('e.dateDebut', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return Exposition[]
     */
    public function findNoCurrent(): array|Exposition
    {
        return $this->createQueryBuilder('e')
            ->where('e.modulePublicActif = :noactif')
            ->setParameter('noactif', false)
            ->orderBy('e.dateDebut', 'ASC')
            ->getQuery()
            ->getArrayResult();
            
    }
    //    /**
    //     * @return Exposition[] Returns an array of Exposition objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Exposition
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
