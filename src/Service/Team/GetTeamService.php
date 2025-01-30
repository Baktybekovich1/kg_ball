<?php

namespace App\Service\Team;

use App\Dto\Team\GetTeamGameInfoDto;
use App\Dto\Team\GetTeamGameListDto;
use App\Dto\Team\GetTeamNameAndGoalTotalInGame;
use App\Dto\Team\GetTeamProgressDto;
use App\Dto\Team\GetTeamSquadListDto;
use App\Dto\Tourney\GetTourneyTitleAndDate;
use App\Entity\Game;
use App\Entity\Player;
use App\Repository\AssistRepository;
use App\Repository\GameRepository;
use App\Repository\GoalRepository;
use App\Repository\PlayerRepository;
use App\Repository\TeamAwardRepository;
use App\Repository\TeamRepository;

readonly class GetTeamService
{
    public function __construct(
        private TeamAwardRepository $teamAwardRepository,
        private GameRepository      $gameRepository,
        private GoalRepository      $goalRepository,
        private AssistRepository    $assistRepository, private PlayerRepository $playerRepository, private TeamRepository $teamRepository,


    )
    {
    }

    public function getProgress($id): GetTeamProgressDto
    {
        return new GetTeamProgressDto(
            $this->teamAwardRepository->getQuantityOfAward($id, 1),
            $this->teamAwardRepository->getQuantityOfAward($id, 2),
            $this->teamAwardRepository->getQuantityOfAward($id, 3));
    }

    public function getGameInfo($id): GetTeamGameInfoDto
    {

        return new GetTeamGameInfoDto($this->gameRepository->GetTeamQuantityAllGames($id),
            $this->goalRepository->getTeamGoalQuantity($id),
            $this->goalRepository->getTeamGoalTypeQuantity($id, 3),
            $this->assistRepository->getTeamAssistQuantity($id),
            $this->goalRepository->getTeamGoalTypeQuantity($id, 4)
        );
    }

    public function getSquadList($id): array
    {
        $team = $this->teamRepository->find($id);
        $players = $this->playerRepository->findBy(['team' => $team]);
        return array_map(fn(Player $player) => new GetTeamSquadListDto(
            $player->getId(),
            $player->getName() . ' ' . $player->getSurname(),
            $team->getTitle(), $player->getPosition()),
            $players);

    }

    public function getGameList($id)
    {
        $games = $this->gameRepository->GetTeamAllGames($id);
        return array_map(fn($game) => new GetTeamGameListDto(
            $game->getId(),
            (array)new GetTeamNameAndGoalTotalInGame(
                $game->getHomeTeam()->getId(),
                $game->getHomeTeam()->getTitle(),
                $this->goalRepository->getTeamGoalInGameQuantity( $game->getHomeTeam()->getId(), $game->getId())
            )
            , (array)new GetTeamNameAndGoalTotalInGame(
            $game->getAwayTeam()->getId(),
            $game->getAwayTeam()->getTitle(),
            $this->goalRepository->getTeamGoalInGameQuantity($game->getAwayTeam()->getId(), $game->getId())
        ),
            (array)new GetTourneyTitleAndDate(
                $game->getTourney()->getId(),
                $game->getTourney()->getTitle(),
                $game->getTourney()->getDate()
            )),
            $games);
    }
}