<?php

namespace App\Service\Tourney\TourneyPrizes;

use App\Dto\Tourney\TourneyPrizes\SetTourneyPrizesDto;
use App\Entity\TourneyTeamPrizes;
use App\Repository\AssistRepository;
use App\Repository\GoalRepository;
use App\Repository\PlayerRepository;
use App\Repository\TeamRepository;
use App\Repository\TourneyRepository;
use App\Repository\TourneyTeamPrizesRepository;
use Symfony\Component\Routing\Attribute\Route;

class TourneyPrizesService
{
    public function __construct(private readonly TeamRepository              $teamRepository,
                                private readonly TourneyRepository           $tourneyRepository,
                                private readonly TourneyTeamPrizesRepository $tourneyTeamPrizesRepository,
                                private readonly PlayerRepository            $playerRepository,
    private readonly GoalRepository $goalRepository,
    private readonly AssistRepository $assistRepository,)
    {
    }

    public function add(SetTourneyPrizesDto $dto): bool
    {
        $prizes = new TourneyTeamPrizes();
        $prizes->setTourney($this->tourneyRepository->find($dto->tourneyId));
        $prizes->setFirstPosition($this->teamRepository->find($dto->firstPositionId));
        $prizes->setSecondPosition($this->teamRepository->find($dto->secondPositionId));
        $prizes->setThirdPosition($this->teamRepository->find($dto->thirdPositionId));

        return $this->tourneyTeamPrizesRepository->save($prizes);
    }

    public function remove(int $id): bool
    {
        $prize = $this->tourneyTeamPrizesRepository->find($id);
        return $this->tourneyTeamPrizesRepository->remove($prize);
    }

    public function edit(SetTourneyPrizesDto $dto, int $id): bool
    {
        $prizes = $this->tourneyTeamPrizesRepository->find($id);
        $prizes->setTourney($this->tourneyRepository->find($dto->tourneyId));
        $prizes->setFirstPosition($this->teamRepository->find($dto->firstPositionId));
        $prizes->setSecondPosition($this->teamRepository->find($dto->secondPositionId));
        $prizes->setThirdPosition($this->teamRepository->find($dto->thirdPositionId));
        return $this->tourneyTeamPrizesRepository->save($prizes);
    }


}