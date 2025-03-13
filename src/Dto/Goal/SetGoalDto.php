<?php

namespace App\Dto\Goal;

class SetGoalDto
{
    public function __construct(
        public int $playerId,
        public int $gameId,
        public int $teamId,
        public int $vsTeamId,
        public int $typeOfGoalId
    )
    {
    }
}