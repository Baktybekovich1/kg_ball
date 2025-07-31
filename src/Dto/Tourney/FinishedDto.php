<?php

namespace App\Dto\Tourney;

class FinishedDto
{

    public function __construct(
        public bool $finished,
    )
    {
    }
}