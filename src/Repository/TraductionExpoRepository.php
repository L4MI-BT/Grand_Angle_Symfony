<?php

namespace App\Repository;

use App\Entity\Exposition;
use App\Entity\Langue;
use App\Entity\TraductionExpo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TraductionExpo>
 */
class TraductionExpoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TraductionExpo::class);
    }

    public function findTraductionByExpoAndLangue(Exposition $exposition, Langue $langue): ?TraductionExpo
    {
    return $this->createQueryBuilder('t')
        ->where('t.exposition = :exposition')
        ->andWhere('t.langue = :langue')
        ->setParameter('exposition', $exposition)
        ->setParameter('langue', $langue)
        ->getQuery()
        ->getOneOrNullResult();
    }

}

