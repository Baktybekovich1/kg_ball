<?php

namespace App\Repository;

use App\Entity\Team;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Team>
 */
class TeamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Team::class);
    }

    public function save(Team $entity): bool
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        return true;
    }

    public function remove(Team $team): bool
    {
        $this->getEntityManager()->remove($team);
        $this->getEntityManager()->flush();
        return true;
    }

}
