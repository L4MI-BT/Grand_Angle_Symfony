<?php

namespace App\Repository;

use App\Entity\Langue;
use App\Entity\Oeuvre;
use App\Entity\TraductionOeuvre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TraductionOeuvre>
 */
class TraductionOeuvreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TraductionOeuvre::class);
    }

    public function findTraductionByOeuvreAndLangue(Oeuvre $oeuvre, Langue $langue): ?TraductionOeuvre
    {
    return $this->createQueryBuilder('t')
        ->where('t.oeuvre = :oeuvre')
        ->andWhere('t.langue = :langue')
        ->setParameter('oeuvre', $oeuvre)
        ->setParameter('langue', $langue)
        ->getQuery()
        ->getOneOrNullResult();
    }

    
}

