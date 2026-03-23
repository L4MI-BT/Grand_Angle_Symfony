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

        /**
     * Récupérer un artiste avec le nombre d'œuvres
     * @param int $id
     * @return array|null
     */
    public function findWithNbOeuvres(int $id): ?array
    {
        return $this->createQueryBuilder('a')
            ->select('a', 'COUNT(o.id) as nbOeuvres')
            ->leftJoin('a.oeuvres', 'o')
            ->where('a.id = :id')
            ->setParameter('id', $id)
            ->groupBy('a.id')
            ->getQuery()
            ->getOneOrNullResult();
    }

        /**
     * Récupérer tous les artistes d'une exposition
     * @param int $idExposition
     * @return Artiste[]
     */
    public function findByExposition(int $idExposition): array
    {
        return $this->createQueryBuilder('a')
            ->innerJoin('a.oeuvres', 'o')
            ->innerJoin('o.exposition', 'e')
            ->where('e.id = :idExpo')
            ->setParameter('idExpo', $idExposition)
            ->distinct()
            ->orderBy('a.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
