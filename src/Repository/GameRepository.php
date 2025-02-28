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
        $qb = $this->createQueryBuilder('game');
        $qb->select('COUNT(game.id)')
            ->where('game.winnerTeam = :teamId')
            ->orWhere('game.loserTeam = :teamid')
            ->setParameter('teamid', $teamId);
        return $qb->getQuery()->getSingleScalarResult();
    }

    public function GetTeamAllGames(int $teamId): ?array
    {
        $qb = $this->createQueryBuilder('g');

        $qb->where('g.winnerTeam = :teamId')
            ->orWhere('g.loserTeam = :teamId')
            ->setParameter('teamId', $teamId);

        return $qb->getQuery()->getResult();
    }

    public function GetTeamWinningsVSTeam(int $firstTeamId, int $secondTeamId): ?int
    {
        $qb = $this->createQueryBuilder('g');
        $qb->select('COUNT(g.id)')
            ->where('g.winnerTeam = :firstTeamId')
            ->andWhere('g.loserTeam = :secondTeamId')
            ->setParameter('firstTeamId', $firstTeamId)
            ->setParameter('secondTeamId', $secondTeamId);
        return $qb->getQuery()->getSingleScalarResult();
    }

}
