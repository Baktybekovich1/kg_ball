<?php

namespace App\Dto\Assist;

class SetAssistDto
{
    public function __construct(
        public int $playerId,
        public int $goalId
    )
    {
    }

}