<?php

namespace App\Dto\Tourney;

class SetTourneyDto
{
    public function __construct(
        public string $title,
        public int    $teams_sum,
        public string $date,
        public int    $year
    )
    {
    }

}