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

    public function getPlayerGoalTypeQuantity(int $player_id,int $typeOfGoal): ?int
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT COUNT(*) FROM goal g LEFT JOIN player p ON g.player_id = p.id WHERE g.player_id = :player_id AND g.type_of_goal_id = :type_of_goal_id ";
        $result = $conn->executeQuery($sql, ['player_id' => $player_id, 'type_of_goal_id' => $typeOfGoal]);
        return $result->fetchOne();

    }
}
