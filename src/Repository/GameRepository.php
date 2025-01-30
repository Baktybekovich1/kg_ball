<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Game>
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    public function GetTeamQuantityAllGames(int $teamId): ?int
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT COUNT(*) FROM game WHERE home_team_id = :team_id OR away_team_id = :team_id";
        $result = $conn->executeQuery($sql, ['team_id' => $teamId]);
        return $result->fetchOne();
    }

    public function GetTeamAllGames(int $teamId): ?array
    {
        $qb = $this->createQueryBuilder('g');

        $qb->where('g.homeTeam = :teamId')
            ->orWhere('g.awayTeam = :teamId')
            ->setParameter('teamId', $teamId);

        return $qb->getQuery()->getResult();
    }

}
