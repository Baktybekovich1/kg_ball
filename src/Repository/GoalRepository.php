<?php

namespace App\Repository;

use App\Entity\Goal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Goal>
 */
class GoalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Goal::class);
    }

    public function getPlayerGoalQuantity(int $player_id): ?int
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT COUNT(*) FROM goal g LEFT JOIN player p ON g.player_id = p.id WHERE g.player_id = :player_id";
        $result = $conn->executeQuery($sql, ['player_id' => $player_id]);
        return $result->fetchOne();
    }

    public function getPlayerGoalTypeQuantity(int $player_id, int $typeOfGoal): ?int
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT COUNT(*) FROM goal g LEFT JOIN player p ON g.player_id = p.id WHERE g.player_id = :player_id AND g.type_of_goal_id = :type_of_goal_id ";
        $result = $conn->executeQuery($sql, ['player_id' => $player_id, 'type_of_goal_id' => $typeOfGoal]);
        return $result->fetchOne();

    }

    public function getTeamGoalQuantity(int $team_id): ?int
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT COUNT(*) FROM goal g LEFT JOIN team t ON g.team_id = t.id WHERE g.team_id = :team_id";
        $result = $conn->executeQuery($sql, ['team_id' => $team_id]);
        return $result->fetchOne();
    }

    public function getTeamGoals(int $team_id)
    {
        $qb = $this->createQueryBuilder('g');
        $qb->where('g.team = :team_id')
            ->setParameter('team_id', $team_id);
        return $qb->getQuery()->getResult();
    }

    public function getTeamGoalInGameQuantity(int $team_id, int $game_id): ?int
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT COUNT(*) FROM goal g WHERE g.team_id = :team_id AND g.game_id = :game_id";
        $result = $conn->executeQuery($sql, ['team_id' => $team_id, 'game_id' => $game_id]);
        return $result->fetchOne();
    }

    public function getTeamGoalTypeQuantity(int $team_id, int $typeOfGoal): ?int
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT COUNT(*) FROM goal g LEFT JOIN team p ON g.team_id = p.id WHERE g.team_id = :team_id AND g.type_of_goal_id = :type_of_goal_id ";
        $result = $conn->executeQuery($sql, ['team_id' => $team_id, 'type_of_goal_id' => $typeOfGoal]);
        return $result->fetchOne();
    }

    public function getTeamGoalQuantityVSTeam(int $first_team_id, int $second_team_id): ?int
    {
        $qb = $this->createQueryBuilder('g');
        $qb->select('COUNT(g.id)')
            ->where('g.team = :first_team_id')
            ->andWhere('g.vs_team = :second_team_id');
        $qb->setParameter('first_team_id', $first_team_id);
        $qb->setParameter('second_team_id', $second_team_id);
        return $qb->getQuery()->getSingleScalarResult();
    }

    public function getPlayerGoalQuantityVSTeam(int $player_id, int $vs_team_id): ?int
    {
        $qb = $this->createQueryBuilder('g');
        $qb->select('COUNT(g.id)')
            ->where('g.player = :player_id')
            ->andWhere('g.vs_team = :vs_team_id');
        $qb->setParameter('player_id', $player_id);
        $qb->setParameter('vs_team_id', $vs_team_id);
        return $qb->getQuery()->getSingleScalarResult();
    }


}
