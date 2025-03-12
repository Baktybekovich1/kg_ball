<?php

namespace App\Repository;

use App\Entity\Goal;
use App\Entity\Player;
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

    public function getPlayerGoalQuantityInTourney(int $player_id, int $tourney_id): ?int
    {
        $qb = $this->createQueryBuilder('g');
        $qb->select('COUNT(g.id)')
            ->leftJoin('g.game', 'game')
            ->where('game.tourney = :tourney_id')
            ->andWhere('g.player = :player_id')
            ->setParameter('tourney_id', $tourney_id)
            ->setParameter('player_id', $player_id);
        return $qb->getQuery()->getSingleScalarResult();
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

    public function getTeamGoalQuantityInTourney(int $team_id, int $tourney_id): ?int
    {
        $qb = $this->createQueryBuilder('g');
        $qb->select('count(g.id)')
            ->leftJoin('g.game', 'game')
            ->where('g.team = :team_id')
            ->andWhere('game.tourney = :tourney_id')
            ->setParameter('team_id', $team_id)
            ->setParameter('tourney_id', $tourney_id);
        return $qb->getQuery()->getSingleScalarResult();
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


    public function getAllGoalsQuantityInTourney(int $tourney_id): ?int
    {
        $qb = $this->createQueryBuilder('goal');
        $qb->select('COUNT(goal.id)')
            ->leftJoin('goal.game', 'game')
            ->where('game.tourney = :tourney_id')
            ->setParameter('tourney_id', $tourney_id);
        return $qb->getQuery()->getSingleScalarResult();
    }

    public function getTeamGoalsInGame(int $team_id, int $game_id): ?array
    {
        $qb = $this->createQueryBuilder('goal');
        $qb->leftJoin('goal.player', 'player')
            ->where('player.team = :team_id')
            ->andWhere('goal.game = :game_id')
            ->setParameter('team_id', $team_id)
            ->setParameter('game_id', $game_id);
        return $qb->getQuery()->getResult();
    }

    public function findBombardierVsTeam(int $teamId, int $vsTeamId): ?array
    {
        $qb = $this->createQueryBuilder('g');

        $qb->select('p.id AS playerId, concat(p.name, \' \', p.surname) AS playerName, COUNT(g.id) AS goalCount')
            ->join('g.player', 'p') // Соединяем с игроками
            ->where('g.team = :teamId') // Ограничиваем команду, которая забивала
            ->andWhere('g.vs_team = :vsTeamId') // Ограничиваем команду, против которой играли
            ->setParameter('teamId', $teamId)
            ->setParameter('vsTeamId', $vsTeamId)
            ->groupBy('p.id') // Группируем по игрокам
            ->orderBy('goalCount', 'DESC') // Сортируем по количеству голов
            ->setMaxResults(1); // Берём только одного игрока

        $result = $qb->getQuery()->getOneOrNullResult();

        if (!$result) {
            return [
                'playerId' => null,
                'playerName' => null,
                'goalCount' => null
            ];
        }

        return $result;
    }

    public function findTourneyBombardier(int $tourney_id): array
    {
        $qb = $this->createQueryBuilder('goal');
        $qb->select('player.id as playerId , concat(player.name,\' \', player.surname) as playerName, COUNT(goal.id) as goalCount')
            ->join('goal.player', 'player')
            ->join('goal.game', ' game')
            ->where('game.tourney = :tourney_id')
            ->setParameter('tourney_id', $tourney_id)
            ->groupBy('player.id')
            ->orderBy('COUNT(goal.id)', 'DESC')
            ->setMaxResults(1);
        return $qb->getQuery()->getOneOrNullResult();
    }


}
