<?php

namespace App\Repository;

use App\Entity\ContenuEnrichi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ContenuEnrichi>
 */
class ContenuEnrichiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContenuEnrichi::class);
    }

}
