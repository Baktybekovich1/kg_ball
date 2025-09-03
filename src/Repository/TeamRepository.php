<?php

namespace App\Repository;

use App\Entity\Team;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Team>
 */
class TeamRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Team::class);
    }

    public function save(Team $entity): bool
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        return true;
    }

    public function remove(Team $team): bool
    {
        $this->getEntityManager()->remove($team);
        $this->getEntityManager()->flush();
        return true;
    }

    /**
     * @throws Exception
     */
    public function findTeamPointsInMonth($team_id, $startDate, $endDate): int
    {
        $sql = <<<SQL
select
    (select count(ttp.first_position_id)
     from tourney_team_prizes ttp
              inner join tourney tour on ttp.tourney_id = tour.id
              inner join team t on ttp.first_position_id = t.id
     where tour.date between :startDate and :endDate and t.id = :teamId)*3 +
    (select count(ttp.second_position_id)
     from tourney_team_prizes ttp
              inner join tourney tour on ttp.tourney_id = tour.id
              inner join team t on ttp.second_position_id = t.id
     where tour.date between :startDate and :endDate and t.id = :teamId)*2 +
    (select count(ttp.third_position_id)
     from tourney_team_prizes ttp
              inner join tourney tour on ttp.tourney_id = tour.id
              inner join team t on ttp.third_position_id = t.id
     where tour.date between :startDate and :endDate and t.id = :teamId)*1 as points 
SQL;
        $points = $this->getEntityManager()->getConnection()->fetchOne($sql, ['startDate' => $startDate, 'endDate' => $endDate, 'teamId' => $team_id]);

        return (int) ($points ?? 0);
    }

}
