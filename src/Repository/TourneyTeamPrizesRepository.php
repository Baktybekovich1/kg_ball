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

    public function getPoints(int $teamId): int
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "
    SELECT SUM(points) as total_points
    FROM (
        SELECT COUNT(*) * 3 as points FROM tourney_team_prizes WHERE first_position_id = :teamId
        UNION ALL
        SELECT COUNT(*) * 2 FROM tourney_team_prizes WHERE second_position_id = :teamId
        UNION ALL
        SELECT COUNT(*) * 1 FROM tourney_team_prizes WHERE third_position_id = :teamId
    ) AS sub
    ";

        $result = $conn->executeQuery($sql, ['teamId' => $teamId])->fetchOne();
        return $result;
    }

    public function save(TourneyTeamPrizes $entity): bool
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        return true;
    }

    public function remove(TourneyTeamPrizes $entity): bool
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        return true;
    }

}
