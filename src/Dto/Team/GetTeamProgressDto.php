<?php

namespace App\Dto\Team;

class GetTeamProgressDto
{
    public function __construct(
        public int $first,
        public int $second,
        public int $third
    )
    {
    }

}