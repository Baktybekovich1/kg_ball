<?php

namespace App\Dto\Team;

class GetTeamPointsDto
{
    public function __construct(
        public int $id,
        public string $title,
        public string|null $logo,
        public int|null $points
    )
    {
    }

}