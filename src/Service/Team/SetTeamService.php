<?php

namespace App\Service\Team;

use App\Entity\Team;
use App\Repository\TeamRepository;

readonly class SetTeamService
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


}