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
}
