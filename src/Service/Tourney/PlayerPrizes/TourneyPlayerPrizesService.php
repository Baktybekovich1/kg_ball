<?php

namespace App\Service\Tourney\PlayerPrizes;

use App\Dto\Prizes\PlayerPrizes\SetTourneyPlayerPrizesDto;
use App\Entity\TourneyPlayerPrizes;
use App\Entity\TourneyTeamPrizes;
use App\Repository\AssistRepository;
use App\Repository\GoalRepository;
use App\Repository\PlayerRepository;
use App\Repository\TourneyPlayerPrizesRepository;
use App\Repository\TourneyRepository;

class TourneyPlayerPrizesService
{
    public function __construct(private readonly PlayerRepository $playerRepository, private readonly GoalRepository $goalRepository, private readonly AssistRepository $assistRepository, private readonly TourneyRepository $tourneyRepository, private readonly TourneyPlayerPrizesRepository $tourneyPlayerPrizesRepository)
    {
    }

    public function add(SetTourneyPlayerPrizesDto $dto): bool
    {
        $bombardier = $this->goalRepository->findTourneyBombardier($dto->tourneyId);
        $bombardier = $this->playerRepository->find($bombardier['playerId']);
        $assistant = $this->assistRepository->findTourneyAssistant($dto->tourneyId);
        $assistant = $this->playerRepository->find($assistant['playerId']);
        $defender = $this->playerRepository->find($dto->defenderId);
        $theBest = $this->playerRepository->getBestPlayersInTourney($dto->tourneyId);
        $theBest = $this->playerRepository->find($theBest[0]['id']);
        $goalkeeper = $this->playerRepository->find($dto->goalkeeperId);
        $tourneyPlayerPrizes = new TourneyPlayerPrizes();
        $tourney = $this->tourneyRepository->find($dto->tourneyId);
        $tourneyPlayerPrizes
            ->setTourney($tourney->getId())
            ->setBombardier($bombardier)
            ->setAssistant($assistant)
            ->setDefender($defender)
            ->setTheBest($theBest)
            ->setGoalkeeper($goalkeeper);
        $tourney->setFinished(true);
        $this->tourneyRepository->save($tourney);
        return $this->tourneyPlayerPrizesRepository->save($tourneyPlayerPrizes);
    }



}