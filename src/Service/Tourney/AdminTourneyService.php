<?php

namespace App\Service\Tourney;

use App\Dto\Tourney\SetTourneyDto;
use App\Entity\Tourney;
use App\Repository\TourneyRepository;

class AdminTourneyService
{
    public function __construct(private readonly TourneyRepository $tourneyRepository)
    {
    }

    public function setTourney(SetTourneyDto $dto): bool
    {
        $tourney = new Tourney();
        $tourney
            ->setTitle($dto->title)
            ->setTeamsSum($dto->teams_sum)
            ->setDate($dto->date)
            ->setYear($dto->year);
        return $this->tourneyRepository->save($tourney);
    }

    public function removeTourney(int $id): bool
    {
        $tourney = $this->tourneyRepository->find($id);
        return $this->tourneyRepository->remove($tourney);
    }

    public function editTourney(SetTourneyDto $dto, int $id):bool
    {
        $tourney = $this->tourneyRepository->find($id);
        $tourney
            ->setTitle($dto->title)
            ->setTeamsSum($dto->teams_sum)
            ->setDate($dto->date)
            ->setYear($dto->year);
        return $this->tourneyRepository->save($tourney);
    }

    public function finishedTourney($id): bool
    {
        $tourney = $this->tourneyRepository->find($id);
        return $tourney->isFinished();
    }

    public function editFinishedTourney($finished,$id): bool
    {
        $tourney = $this->tourneyRepository->find($id);
        $tourney->setFinished($finished);
        return $this->tourneyRepository->save($tourney);
    }

}