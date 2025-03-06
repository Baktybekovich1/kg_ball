<?php

namespace App\Service\Team;

use App\Dto\Team\EditTeamDto;
use App\Entity\Team;
use App\Repository\TeamRepository;

readonly class AdminTeamService
{
    public function __construct(private TeamRepository $teamRepository)
    {
    }

    public function setTeam($title, $logo): bool
    {
        $team = new Team();
        $team->setTitle($title);
        $team->setLogo($logo);
        return $this->teamRepository->save($team);
    }

    public function removeTeam(int $id): bool
    {
        $team = $this->teamRepository->find($id);
        return $this->teamRepository->remove($team);
    }

    public function editTeam(EditTeamDto $dto): bool
    {
        $team = $this->teamRepository->find($dto->id);
        $team->setTitle($dto->title)
            ->setLogo($dto->logo);
        return $this->teamRepository->save($team);
    }
}