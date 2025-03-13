<?php

namespace App\Service\Game;

use App\Dto\Game\SetGameDto;
use App\Entity\Game;
use App\Repository\GameRepository;
use App\Repository\TeamRepository;
use App\Repository\TourneyRepository;

readonly class AdminGameService
{
    public function __construct(
        private GameRepository    $gameRepository,
        private TourneyRepository $tourneyRepository,
        private TeamRepository    $teamRepository
    )
    {
    }

    public function add($dto): bool
    {
        $game = new Game();
        $game->setTourney($this->tourneyRepository->find($dto->tourneyId));
        $game->setWinnerTeam($this->teamRepository->find($dto->winnerTeamId));
        $game->setLoserTeam($this->teamRepository->find($dto->loserTeamId));
        return $this->gameRepository->save($game);
    }

    public function remove(int $gameId): bool
    {
        $game = $this->gameRepository->find($gameId);
        return $this->gameRepository->remove($game);
    }

    public function edit(SetGameDto $dto, int $gameId): bool
    {
        $game = $this->gameRepository->find($gameId);
        $game->setTourney($this->tourneyRepository->find($dto->tourneyId));
        $game->setWinnerTeam($this->teamRepository->find($dto->winnerTeamId));
        $game->setLoserTeam($this->teamRepository->find($dto->loserTeamId));
        return $this->gameRepository->save($game);
    }

}