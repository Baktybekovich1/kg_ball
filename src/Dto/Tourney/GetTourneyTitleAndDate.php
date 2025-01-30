<?php

namespace App\Dto\Tourney;

class GetTourneyTitleAndDate
{
    public function __construct(
        public int    $id,
        public string $title,
        public string $date
    )
    {
    }

}