<?php

namespace App\Dto\Player;

class GetPlayerGoalAndAssist
{
    public function __construct(
        public int    $playerId,
        public string $name,
        public int    $goals,
        public int    $assists
    )
    {
    }

}