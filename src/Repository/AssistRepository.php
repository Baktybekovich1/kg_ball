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

    public function getTeamAssistQuantity(int $team_id): ?int
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT COUNT(*) FROM assist g WHERE g.team_id = :team_id";
        $result = $conn->executeQuery($sql, ['team_id' => $team_id]);
        return $result->fetchOne();
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
}
