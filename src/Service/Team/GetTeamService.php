<?php

namespace App\Service\Team;

use App\Dto\Player\GetPlayerGoalAndAssist;
use App\Dto\Player\GetPlayerNameAndAssists;
use App\Dto\Player\GetPlayerNameAndGoals;
use App\Dto\Team\GetTeamGameInfoDto;
use App\Dto\Team\GetTeamGameListDto;
use App\Dto\Team\GetTeamNameAndGoalTotalInGame;
use App\Dto\Team\GetTeamProgressDto;
use App\Dto\Team\GetTeamSquadListDto;
use App\Dto\Team\GetTeamStatisticsDto;
use App\Dto\Team\GetTwoTeamsDto;
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

    public function getGameList($id): array
    {
        $games = $this->gameRepository->GetTeamAllGames($id);
        return array_map(fn($game) => new GetTeamGameListDto(
            $game->getId(),
            (array)new GetTeamNameAndGoalTotalInGame(
                $game->getHomeTeam()->getId(),
                $game->getHomeTeam()->getTitle(),
                $this->goalRepository->getTeamGoalInGameQuantity($game->getHomeTeam()->getId(), $game->getId())
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

    public function getBestPlayers(int $id)
    {
        $team = $this->teamRepository->find($id);
        $players = $this->playerRepository->findBy(['team' => $team]);
        $result = [];
        foreach ($players as $player) {
            $goals = $this->goalRepository->getPlayerGoalQuantity($player->getId());
            $assists = $this->assistRepository->getPlayerAssistQuantity($player->getId());
            if ($goals != 0 && $assists != 0) {
                $result[] = new GetPlayerGoalAndAssist(
                    $player->getId(),
                    $player->getName() . ' ' . $player->getSurname(),
                    $goals,
                    $assists,
                );
            }
        }
        return $result;
    }

    public function getGameStatistics(int $firstTeamId, int $secondTeamId)
    {

        return new GetTwoTeamsDto(
            new GetTeamStatisticsDto(
                $firstTeamId,
                $this->gameRepository->GetTeamWinningsVSTeam($firstTeamId, $secondTeamId),
                $this->goalRepository->getTeamGoalQuantityVSTeam($firstTeamId, $secondTeamId),
                $this->assistRepository->getTeamAssistQuantityVSTeam($firstTeamId, $secondTeamId),
                new GetPlayerNameAndGoals(
                    $this->getTeamBombardier($firstTeamId, $secondTeamId)->getId(),
                    $this->getTeamBombardier($firstTeamId, $secondTeamId)->getName(),
                    count($this->getTeamBombardier($firstTeamId, $secondTeamId)->getGoals())
                ),
                new GetPlayerNameAndAssists(
                    $this->getTeamAssistant($firstTeamId, $secondTeamId)->getId(),
                    $this->getTeamAssistant($firstTeamId, $secondTeamId)->getName(),
                    count($this->getTeamAssistant($firstTeamId, $secondTeamId)->getAssists())
                )
            ),
            new GetTeamStatisticsDto(
                $secondTeamId,
                $this->gameRepository->GetTeamWinningsVSTeam($secondTeamId, $firstTeamId),
                $this->goalRepository->getTeamGoalQuantityVSTeam($secondTeamId, $firstTeamId),
                $this->assistRepository->getTeamAssistQuantityVSTeam($secondTeamId, $firstTeamId),
                new GetPlayerNameAndGoals(
                    $this->getTeamBombardier($secondTeamId, $firstTeamId)->getId(),
                    $this->getTeamBombardier($secondTeamId, $firstTeamId)->getName(),
                    count($this->getTeamBombardier($secondTeamId, $firstTeamId)->getGoals()),
                ),
                new GetPlayerNameAndAssists(
                    $this->getTeamAssistant($secondTeamId, $firstTeamId)->getId(),
                    $this->getTeamAssistant($secondTeamId, $firstTeamId)->getName(),
                    count($this->getTeamAssistant($secondTeamId, $firstTeamId)->getAssists()),
                )
            )
        );


    }

    public function getTeamBombardier(int $team_id, int $vs_team_id)
    {
        $players = $this->playerRepository->findBy(['team' => $team_id]);
        $bombardier = $players[array_rand($players)];
        $b = 0;
        foreach ($players as $player) {
            $goals = $this->goalRepository->getPlayerGoalQuantityVSTeam($player->getId(), $vs_team_id);
            if ($goals > $b) {
                $b = $goals;
                $bombardier = $player;
            }
        }
        return $bombardier;
    }

    public function getTeamAssistant(int $team_id, int $vs_team_id)
    {
        $players = $this->playerRepository->findBy(['team' => $team_id]);
        $assistant = $players[array_rand($players)];
        $a = 0;
        foreach ($players as $player) {
            $assist = $this->assistRepository->getPlayerAssistQuantityVSTeam($player->getId(), $vs_team_id);
            if ($assist > $a) {
                $a = $assist;
                $assistant = $player;
            }
        }
        return $assistant;

    }

}