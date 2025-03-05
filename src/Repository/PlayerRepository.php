<?php

namespace App\Repository;

use App\Entity\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Player>
 */
class PlayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Player::class);
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

    public function getTourneyBombardier(int $tourney_id): ?Player
    {
        $qb = $this->createQueryBuilder('p');
        $qb->select('p')
            ->leftJoin('p.goals', 'goals')
            ->leftJoin('goals.game', 'game')
            ->where('game.tourney = :tourney_id')
            ->setParameter('tourney_id', $tourney_id);
        $qb->setMaxResults(1);
        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getTourneyAssistant(int $tourney_id): ?Player
    {
        $qb = $this->createQueryBuilder('p');
        $qb->select('p')
            ->leftJoin('p.assists', 'assists')
            ->leftJoin('assists.goal', 'goal')
            ->leftJoin('goal.game', 'game')
            ->where('game.tourney = :tourney_id')
            ->setParameter('tourney_id', $tourney_id);
        $qb->setMaxResults(1);
        return $qb->getQuery()->getOneOrNullResult();
    }

    public function save(Player $entity): bool
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        return true;
    }

    public function remove(Player $entity): bool
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
        return true;
    }


}
