<?php

namespace App\Repository;

use App\Entity\Oeuvre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Oeuvre>
 */
class OeuvreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Oeuvre::class);
    }

        /**
     * Récupérer toutes les œuvres d'une exposition avec leurs artistes
     * 
     * @param int $idExposition
     * @return Oeuvre[]
     */
    public function findByExposition(int $idExposition): array
    {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.artiste', 'a')
            ->addSelect('a')
            ->where('o.exposition = :expo')
            ->setParameter('expo', $idExposition)
            ->orderBy('o.ordreVisite', 'ASC')
            ->getQuery()
            ->getResult();
    }

        /**
     * Récupérer toutes les œuvres d'un artiste avec détails complets
     * 
     * @param int $idArtiste
     * @return Oeuvre[]
     */
    public function findByArtisteWithDetails(int $idArtiste): array
    {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.artiste', 'a')
            ->addSelect('a')
            ->leftJoin('o.exposition', 'e')
            ->addSelect('e')
            ->leftJoin('o.emplacement', 'emp')
            ->addSelect('emp')
            ->where('o.artiste = :artiste')
            ->setParameter('artiste', $idArtiste)
            ->orderBy('o.anneeCreation', 'DESC')
            ->getQuery()
            ->getResult();
    }

        /**
     * Récupérer une œuvre avec toutes ses relations
     * (artiste, exposition, emplacement, contenus enrichis, traductions)
     * 
     * @param int $id
     * @return Oeuvre|null
     */
    public function findWithAllRelations(int $id): ?Oeuvre
    {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.artiste', 'a')
            ->addSelect('a')
            ->leftJoin('o.exposition', 'e')
            ->addSelect('e')
            ->leftJoin('o.emplacement', 'emp')
            ->addSelect('emp')
            ->leftJoin('o.contenuEnrichis', 'ce')
            ->addSelect('ce')
            ->leftJoin('o.traductions', 't')
            ->addSelect('t')
            ->where('o.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

        /**
     * Récupérer les œuvres récemment ajoutées
     * 
     * @param int $limit
     * @return Oeuvre[]
     */
    public function findRecent(int $limit = 10): array
    {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.artiste', 'a')
            ->addSelect('a')
            ->orderBy('o.dateAjout', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

        /**
     * Compter le nombre d'œuvres dans une exposition
     * 
     * @param int $idExposition
     * @return int
     */
    public function countByExposition(int $idExposition): int
    {
        return $this->createQueryBuilder('o')
            ->select('COUNT(o.id)')
            ->where('o.exposition = :expo')
            ->setParameter('expo', $idExposition)
            ->getQuery()
            ->getSingleScalarResult();
    }

}
