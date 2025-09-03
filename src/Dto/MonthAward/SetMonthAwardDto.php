<?php

namespace App\Dto\MonthAward;

class SetMonthAwardDto
{
    public function __construct(
        public string $name,
        public string $startDate,
        public string $endDate,
        public int $defenderId,
        public int $goalkeeperId,
        public int $teamId
    )
    {
    }

}