<?php

namespace App\Repository;

use App\Entity\ContenuEnrichi;
use App\Entity\Langue;
use App\Entity\TraductionContenuEnrichi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TraductionContenuEnrichi>
 */
class TraductionContenuEnrichiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TraductionContenuEnrichi::class);
    }

    public function findTraductionByContenuAndLangue(ContenuEnrichi $contenuEnrichi, Langue $langue): ?TraductionContenuEnrichi
    {
    return $this->createQueryBuilder('t')
        ->where('t.contenuEnrichi = :contenuEnrichi')
        ->andWhere('t.langue = :langue')
        ->setParameter('contenuEnrichi', $contenuEnrichi)
        ->setParameter('langue', $langue)
        ->getQuery()
        ->getOneOrNullResult();
    }

}
