<?php

namespace App\Dto\Team;

class GetTeamNameAndGoalTotalInGame
{
    public function __construct(
        public string $id,
        public string $name,
        public int $goalTotalInGame,
        public string|null $logo
    )
    {
    }

}