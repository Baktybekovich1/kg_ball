<?php

namespace App\Service\MonthAward;

use App\Dto\MonthAward\SetMonthAwardDto;
use App\Entity\Months;
use App\Repository\MonthsRepository;
use App\Repository\MonthTeamAwardRepository;
use App\Repository\TeamRepository;

class MonthAwardEditService
{
    public function __construct(
        private readonly TeamRepository               $teamRepository,
        private readonly MonthsRepository             $monthsRepository,
        private  readonly MonthPlayerAwardEditService $monthPlayerAwardEditService, private readonly MonthTeamAwardRepository $monthTeamAwardRepository, )
    {
    }

    public function add(SetMonthAwardDto $dto):bool
    {
//        $month = new Months();
//        $month->setName($dto->name)
//            ->setStartDate($dto->startDate)
//            ->setEndDate($dto->endDate);
//        $this->monthsRepository->save($month);
//        $this->monthTeamAwardRepository->save();
//        $this->monthPlayerAwardEditService->add($dto,$month->getId());

    return false;
    }

}