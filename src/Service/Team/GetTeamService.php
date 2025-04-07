<?php

namespace App\Service\Team;

use App\Dto\Player\GetPlayerGoalAndAssist;
use App\Dto\Player\GetPlayerNameAndAssistsDto;
use App\Dto\Player\GetPlayerNameAndGoalsDto;
use App\Dto\Team\GetTeamGameInfoDto;
use App\Dto\Team\GetTeamGameListDto;
use App\Dto\Team\GetTeamNameAndGoalTotalInGame;
use App\Dto\Team\GetTeamPointsDto;
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
use App\Repository\TeamRepository;
use App\Repository\TourneyTeamPrizesRepository;

readonly class GetTeamService
{
    public function __construct(
        private GameRepository              $gameRepository,
        private GoalRepository              $goalRepository,
        private AssistRepository            $assistRepository,
        private PlayerRepository            $playerRepository,
        private TeamRepository              $teamRepository,
        private TourneyTeamPrizesRepository $tourneyTeamPrizesRepository,
    )
    {
    }

    public function getProgress($id): GetTeamProgressDto
    {
        return new GetTeamProgressDto(
            $this->tourneyTeamPrizesRepository->getTeamFirstPositionQuantity($id),
            $this->tourneyTeamPrizesRepository->getTeamSecondPositionQuantity($id),
            $this->tourneyTeamPrizesRepository->getTeamThirdPositionQuantity($id));
    }

    public function getGameInfo($id): GetTeamGameInfoDto
    {

        return new GetTeamGameInfoDto(
            $this->gameRepository->GetTeamQuantityAllGames($id),
            $this->goalRepository->getTeamGoalQuantity($id),
            $this->goalRepository->getTeamGoalTypeQuantity($id, 3),
            $this->assistRepository->getTeamAssistQuantity($id)
        );
    }

    public function getSquadList($id): array
    {
        $team = $this->teamRepository->find($id);
        $players = $this->playerRepository->findBy(['team' => $team]);
        return array_map(fn(Player $player) => new GetTeamSquadListDto(
            $player->getId(),
            $player->getName() . ' ' . $player->getSurname(),
            $team->getTitle(), $player->getPosition(), $player->getImg()),
            $players);

    }

    public function getGameList($id): array
    {
        $games = $this->gameRepository->GetTeamAllGames($id);
        return array_map(fn($game) => new GetTeamGameListDto(
            $game->getId(),
            (array)new GetTeamNameAndGoalTotalInGame(
                $game->getWinnerTeam()->getId(),
                $game->getWinnerTeam()->getTitle(),
                $this->goalRepository->getTeamGoalInGameQuantity($game->getWinnerTeam()->getId(), $game->getId()),
                $game->getWinnerTeam()->getLogo(),
            )
            , (array)new GetTeamNameAndGoalTotalInGame(
            $game->getLoserTeam()->getId(),
            $game->getLoserTeam()->getTitle(),
            $this->goalRepository->getTeamGoalInGameQuantity($game->getLoserTeam()->getId(), $game->getId()),
            $game->getloserTeam()->getLogo()
        ),
            (array)new GetTourneyTitleAndDate(
                $game->getTourney()->getId(),
                $game->getTourney()->getTitle(),
                $game->getTourney()->getDate()
            )),
            $games);
    }

    public function getBestPlayers(int $id): array
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
                    $player->getImg()
                );
            }
        }
        return $result;
    }

    public function getGameStatistics(int $firstTeamId, int $secondTeamId)
    {
        $firstTeamBombardier = $this->goalRepository->findBombardierVsTeam($firstTeamId, $secondTeamId);
        $firstTeamAssistant = $this->assistRepository->findAssistantVsTeam($firstTeamId, $secondTeamId);
        $secondTeamBombardier = $this->goalRepository->findBombardierVsTeam($secondTeamId, $firstTeamId);
        $secondTeamAssistant = $this->assistRepository->findAssistantVsTeam($secondTeamId, $firstTeamId);

        return new GetTwoTeamsDto(
            new GetTeamStatisticsDto(
                $firstTeamId,
                $this->gameRepository->GetTeamWinningsVSTeam($firstTeamId, $secondTeamId),
                $this->goalRepository->getTeamGoalQuantityVSTeam($firstTeamId, $secondTeamId),
                $this->assistRepository->getTeamAssistQuantityVSTeam($firstTeamId, $secondTeamId),
                new GetPlayerNameAndGoalsDto(
                    $firstTeamBombardier['playerId'],
                    $firstTeamBombardier['playerName'],
                    $firstTeamBombardier['goalCount']
                ),
                new GetPlayerNameAndAssistsDto(
                    $firstTeamAssistant['playerId'],
                    $firstTeamAssistant['playerName'],
                    $firstTeamAssistant['assistCount']
                )
            ),
            new GetTeamStatisticsDto(
                $secondTeamId,
                $this->gameRepository->GetTeamWinningsVSTeam($secondTeamId, $firstTeamId),
                $this->goalRepository->getTeamGoalQuantityVSTeam($secondTeamId, $firstTeamId),
                $this->assistRepository->getTeamAssistQuantityVSTeam($secondTeamId, $firstTeamId),
                new GetPlayerNameAndGoalsDto(
                    $secondTeamBombardier['playerId'],
                    $secondTeamBombardier['playerName'],
                    $secondTeamBombardier['goalCount']
                ),
                new GetPlayerNameAndAssistsDto(
                    $secondTeamAssistant['playerId'],
                    $secondTeamAssistant['playerName'],
                    $secondTeamAssistant['assistCount']
                )
            )
        );
    }

    public function getBestTeams(): array
    {
        $db_teams = $this->teamRepository->findAll();
        $teams = [];
        foreach ($db_teams as $team) {
            $teams[] = new GetTeamPointsDto(
                $team->getId(),
                $team->getTitle(),
                $team->getLogo(),
                $this->pointsCalculate($team)
            );
        }
        return $teams;
    }

    private function pointsCalculate($team): int
    {
        return count($this->gameRepository->findBy(['winnerTeam' => $team])) * 3;
    }

    public function getPrizes(int $teamId)
    {
        $team = $this->teamRepository->find($teamId);
        $firstPositionPrizes = $this->tourneyTeamPrizesRepository->findBy(['firstPosition' => $team]);
        $secondPositionPrizes = $this->tourneyTeamPrizesRepository->findBy(['secondPosition' => $team]);
        $thirdPositionPrizes = $this->tourneyTeamPrizesRepository->findBy(['thirdPosition' => $team]);
        dd($firstPositionPrizes);
    }

}