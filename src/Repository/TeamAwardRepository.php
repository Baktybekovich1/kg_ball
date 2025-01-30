<?php

namespace App\Repository;

use App\Entity\Team;
use App\Entity\TeamAward;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TeamAward>
 */
class TeamAwardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TeamAward::class);
    }

    public function getQuantityOfAward(int $teamId, int $awardId): ?int
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT COUNT(*) FROM team_award WHERE team_id = :team_id AND award_for_team_id = :award_id";
        $result = $conn->executeQuery($sql, ['team_id' => $teamId, 'award_id' => $awardId]);
        return $result->fetchOne();
    }
}
