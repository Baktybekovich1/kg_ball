<?php

namespace App\Repository;

use App\Entity\TourneyTeamPrizes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TourneyTeamPrizes>
 */
class TourneyTeamPrizesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TourneyTeamPrizes::class);
    }

    public function getTeamFirstPositionQuantity(int $teamId): int
    {
        $qb = $this->createQueryBuilder('tourney_team_prizes');
        $qb->select('COUNT(tourney_team_prizes.id)')
            ->where('tourney_team_prizes.firstPosition = :teamId')
            ->setParameter('teamId', $teamId);
        return $qb->getQuery()->getSingleScalarResult();
    }

    public function getTeamSecondPositionQuantity(int $teamId): int
    {
        $qb = $this->createQueryBuilder('tourney_team_prizes');
        $qb->select('COUNT(tourney_team_prizes.id)')
            ->where('tourney_team_prizes.secondPosition = :teamId')
            ->setParameter('teamId', $teamId);
        return $qb->getQuery()->getSingleScalarResult();
    }
    public function getTeamThirdPositionQuantity(int $teamId): int
    {
        $qb = $this->createQueryBuilder('tourney_team_prizes');
        $qb->select('COUNT(tourney_team_prizes.id)')
            ->where('tourney_team_prizes.thirdPosition = :teamId')
            ->setParameter('teamId', $teamId);
        return $qb->getQuery()->getSingleScalarResult();
    }
}
