<?php

namespace App\Repository;

use App\Entity\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr;

/**
 * @extends ServiceEntityRepository<Player>
 */
class PlayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Player::class);
        $this->conn = $registry->getConnection();
    }

    public function getTeamBombardier(int $team_id): ?Player
    {
        $qb = $this->createQueryBuilder('p');
        $qb->select('p')
            ->leftJoin('p.goals', 'goals')
            ->where('p.team = :team_id')
            ->setParameter('team_id', $team_id);
        $qb->setMaxResults(1);
        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getTeamAssistant(int $team_id): ?Player
    {
        $qb = $this->createQueryBuilder('p');
        $qb->select('p')
            ->leftJoin('p.assists', 'assists')
            ->where('p.team = :team_id')
            ->setParameter('team_id', $team_id);
        $qb->setMaxResults(1);
        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getBestPlayersInTourney(int $tourneyId): array
    {
        $sql = <<<SQL
SELECT
    p.id,
    p.name,
    COALESCE(goals.goals_count, 0) AS total_goals,
    COALESCE(assists.assists_count, 0) AS total_assists,
    COALESCE(goals.goals_count, 0) + COALESCE(assists.assists_count, 0) AS total_points
FROM
    player p
LEFT JOIN (
    SELECT
        g.player_id,
        COUNT(g.id) AS goals_count
    FROM
        goal g
    INNER JOIN game ga ON g.game_id = ga.id
    WHERE
        ga.tourney_id = :tourneyId
    GROUP BY
        g.player_id
) goals ON p.id = goals.player_id
LEFT JOIN (
    SELECT
        a.player_id,
        COUNT(a.id) AS assists_count
    FROM
        assist a
    INNER JOIN goal g ON a.goal_id = g.id
    INNER JOIN game ga ON g.game_id = ga.id
    WHERE
        ga.tourney_id = :tourneyId
    GROUP BY
        a.player_id
) assists ON p.id = assists.player_id
ORDER BY
    total_points DESC,
    total_goals DESC,
    total_assists DESC,
    p.name ASC
SQL;

        return $this->conn->fetchAllAssociative($sql, ['tourneyId' => $tourneyId]);
    }


    public
    function save(Player $entity): bool
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        return true;
    }

    public
    function remove(Player $entity): bool
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
        return true;
    }


}
