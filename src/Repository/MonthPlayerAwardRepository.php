<?php

namespace App\Repository;

use App\Entity\MonthPlayerAward;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MonthPlayerAward>
 */
class MonthPlayerAwardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MonthPlayerAward::class);
    }

    public function save(MonthPlayerAward $entity): bool
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        return true;
    }
    public function remove(MonthPlayerAward $entity): bool
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
        return true;
    }
}
