<?php

namespace App\Repository;

use App\Entity\Assist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Assist>
 */
class AssistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Assist::class);
    }

    public function getPlayerAssistQuantity(int $player_id): ?int
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT COUNT(*) FROM assist g LEFT JOIN player p ON g.player_id = p.id WHERE g.player_id = :player_id";
        $result = $conn->executeQuery($sql, ['player_id' => $player_id]);
        return $result->fetchOne();
    }

    public function getPlayerAssistQuantityInTourney(int $player_id, int $tourney_id): ?int
    {
        $qb = $this->createQueryBuilder('assist');
        $qb->select('COUNT(assist.id)')
            ->leftJoin('assist.goal', 'goal')
            ->leftJoin('goal.game', 'game')
            ->where('game.tourney = :tourney_id')
            ->andWhere('assist.player = :player_id')
            ->setParameter('tourney_id', $tourney_id)
            ->setParameter('player_id', $player_id);
        return $qb->getQuery()->getSingleScalarResult();

    }

    public function getTeamAssistQuantity(int $team_id): ?int
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT COUNT(*) FROM assist g WHERE g.team_id = :team_id";
        $result = $conn->executeQuery($sql, ['team_id' => $team_id]);
        return $result->fetchOne();
    }

    public function getTeamAssistQuantityInTourney(int $team_id, int $tourney_id): ?int
    {
        $qb = $this->createQueryBuilder('a');
        $qb->select('count(a.id)')
            ->leftJoin('a.goal', 'goal')
            ->leftJoin('goal.game', 'game')
            ->andWhere('game.tourney = :tourney_id')
            ->andWhere('goal.team = :team_id')
            ->setParameter('tourney_id', $tourney_id)
            ->setParameter('team_id', $team_id);
        return $qb->getQuery()->getSingleScalarResult();

    }

    public function getTeamAssistQuantityVSTeam(int $first_team_id, int $second_team_id): ?int
    {
        $qb = $this->createQueryBuilder('assist');
        $qb->select('count(assist.id)')
            ->where('assist.team = :first_team_id')
            ->andWhere('assist.vs_team = :second_team_id');
        $qb->setParameter('first_team_id', $first_team_id);
        $qb->setParameter('second_team_id', $second_team_id);
        $result = $qb->getQuery()->getSingleScalarResult();
        return $result;
    }

    public function getPlayerAssistQuantityVSTeam(int $player_id, int $vs_team_id): ?int
    {
        $qb = $this->createQueryBuilder('assist');
        $qb->select('count(assist.id)')
            ->where('assist.player = :player_id')
            ->andWhere('assist.vs_team = :vs_team_id');
        $qb->setParameter('player_id', $player_id);
        $qb->setParameter('vs_team_id', $vs_team_id);
        $result = $qb->getQuery()->getSingleScalarResult();
        return $result;
    }

    public function getAllAssistsQuantityInTourney(int $tourney_id): ?int
    {
        $qb = $this->createQueryBuilder('assist');
        $qb->select('count(assist.id)')
            ->leftJoin('assist.goal', 'goal')
            ->leftJoin('goal.game', 'game')
            ->where('game.tourney = :tourney_id')
            ->setParameter('tourney_id', $tourney_id);
        return $qb->getQuery()->getSingleScalarResult();
    }

    public function findAssistantVsTeam(int $team_id, int $vs_team_id): ?array
    {
        $qb = $this->createQueryBuilder('assist');
        $qb->select('player.id as playerId , concat(player.name,\' \', player.surname) as playerName, COUNT(assist.id) as assistCount ')
            ->join('assist.player', 'player')
            ->where('assist.team = :team_id')
            ->andWhere('assist.vs_team = :vs_team_id')
            ->setParameter('team_id', $team_id)
            ->setParameter('vs_team_id', $vs_team_id)
            ->groupBy('player.id')
            ->orderBy('assistCount', 'DESC')
            ->setMaxResults(1);

        $result = $qb->getQuery()->getOneOrNullResult();
        if (!$result) {
            return [
                'playerId' => null,
                'playerName' => null,
                'assistCount' => null
            ];
        }

        return $result;
    }

    public function findTourneyAssistant(int $tourney_id): array
    {
        $qb = $this->createQueryBuilder('assist');
        $qb->select('player.id as playerId , concat(player.name,\' \', player.surname) as playerName, COUNT(assist.id) as assistCount')
            ->join('assist.goal', 'goal')
            ->join('goal.game', 'game')
            ->join('assist.player', 'player')
            ->where('game.tourney = :tourney_id')
            ->groupBy('player.id')
            ->orderBy('COUNT(player.id)', 'DESC')
            ->setParameter('tourney_id', $tourney_id)
            ->setMaxResults(1);
        return $qb->getQuery()->getOneOrNullResult();
    }

    public function save(Assist $entity): bool
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        return true;
    }

    public function remove(Assist $entity): bool
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
        return true;
    }
}
