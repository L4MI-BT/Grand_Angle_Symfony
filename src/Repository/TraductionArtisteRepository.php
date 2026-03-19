<?php

namespace App\Repository;

use App\Entity\Artiste;
use App\Entity\Langue;
use App\Entity\TraductionArtiste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TraductionArtiste>
 */
class TraductionArtisteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TraductionArtiste::class);
    }

    public function findTraductionByArtisteAndLangue(Artiste $artiste, Langue $langue): ?TraductionArtiste
    {
    return $this->createQueryBuilder('t')
        ->where('t.artiste = :artiste')
        ->andWhere('t.langue = :langue')
        ->setParameter('artiste', $artiste)
        ->setParameter('langue', $langue)
        ->getQuery()
        ->getOneOrNullResult();
    }
}
