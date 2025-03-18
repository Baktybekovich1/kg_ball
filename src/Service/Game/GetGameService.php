<?php

namespace App\Service\Game;

use App\Dto\Assist\GetAssistInfoDto;
use App\Dto\Game\GetAssistsInGameDto;
use App\Dto\Game\GetGameDto;
use App\Dto\Game\GetGameGoalsDto;
use App\Dto\Game\GetGameScoresDto;
use App\Dto\Goal\GetGoalInfoDto;
use App\Dto\Player\GetPlayerNameAndAssistsDto;
use App\Dto\Player\GetPlayerNameAndGoalsDto;
use App\Dto\Player\GetPlayerNameDto;
use App\Repository\AssistRepository;
use App\Repository\GameRepository;
use App\Repository\GoalRepository;
use App\Repository\TourneyRepository;

readonly class GetGameService
{
    public function __construct(private GameRepository $gameRepository, private GoalRepository $goalRepository, private AssistRepository $assistRepository, private TourneyRepository $tourneyRepository)
    {
    }

    public function getGameScores(int $id): getGameScoresDto
    {
        $game = $this->gameRepository->find($id);
        return new GetGameScoresDto(
            $game->getId(),
            $game->getWinnerTeam()->getId(),
            $game->getWinnerTeam()->getTitle(),
            $this->goalRepository->getTeamGoalInGameQuantity($game->getWinnerTeam()->getId(), $game->getId()),
            $game->getLoserTeam()->getId(),
            $game->getLoserTeam()->getTitle(),
            $this->goalRepository->getTeamGoalInGameQuantity($game->getLoserTeam()->getId(), $game->getId())

        );
    }

    public function getGameGoals(int $id): getGameGoalsDto
    {
        $game = $this->gameRepository->find($id);

//        dd($this->goalRepository->getTeamGoalsInGame($game->getWinnerTeam()->getId(), $game->getId()));
        return new GetGameGoalsDto(
            $this->goals($this->goalRepository->getTeamGoalsInGame($game->getWinnerTeam()->getId(), $game->getId())),
            $this->goals($this->goalRepository->getTeamGoalsInGame($game->getLoserTeam()->getId(), $game->getId()))
        );

    }

    public function goals($go)
    {
        $goals = [];
        foreach ($go as $goal) {
            if ($goal->getAssist()) {
                $goals[] = new GetGoalInfoDto(
                    $goal->getId(),
                    new GetPlayerNameDto(
                        $goal->getPlayer()->getId(),
                        $goal->getPlayer()->getName() . ' ' . $goal->getPlayer()->getSurname()
                    ),
                    $goal->getAssist()->getId(),
                    new GetPlayerNameDto(
                        $goal->getAssist()->getPlayer()->getId(),
                        $goal->getAssist()->getPlayer()->getName() . ' ' . $goal->getAssist()->getPlayer()->getSurname()
                    )
                );
            } else {
                $goals[] = new GetGoalInfoDto(
                    $goal->getId(),
                    new GetPlayerNameDto(
                        $goal->getPlayer()->getId(),
                        $goal->getPlayer()->getName() . ' ' . $goal->getPlayer()->getSurname()
                    ), null
                );
            }
        }
        return $goals;

    }

    public function getAllGames(): array
    {
        $db_games = $this->gameRepository->findAll();
        $games = [];
        foreach ($db_games as $game) {
            $games[] = new GetGameScoresDto(
                $game->getId(),
                $game->getWinnerTeam()->getId(),
                $game->getWinnerTeam()->getTitle(),
                $this->goalRepository->getTeamGoalInGameQuantity($game->getWinnerTeam()->getId(), $game->getId()),
                $game->getLoserTeam()->getId(),
                $game->getLoserTeam()->getTitle(),
                $this->goalRepository->getTeamGoalInGameQuantity($game->getLoserTeam()->getId(), $game->getId())
            );
        }
        return $games;
    }

    public function getTourneyGames(int $id): array
    {

        $games = $this->gameRepository->findBy(['tourney' => $this->tourneyRepository->find($id)]);
        $result = [];
        foreach ($games as $game) {
            $result[] = new GetGameDto(
                $game->getId(),
                $game->getTourney()->getId(),
                $game->getTourney()->getTitle(),
                $game->getWinnerTeam()->getId(),
                $game->getWinnerTeam()->getTitle(),
                count($this->goalRepository->getTeamGoalsInGame($game->getWinnerTeam()->getId(), $game->getId())),
                $game->getLoserTeam()->getId(),
                $game->getLoserTeam()->getTitle(),
                count($this->goalRepository->getTeamGoalsInGame($game->getLoserTeam()->getId(), $game->getId()))
            );
        }
        return $result;

    }

    public function getGameAssists(int $gameId): GetAssistsInGameDto
    {
        $game = $this->gameRepository->find($gameId);
        return new GetAssistsInGameDto($this->getTeamAssistsInGame($this->assistRepository->findTeamAssistsInGame($gameId, $game->getWinnerTeam()->getId())),
            $this->getTeamAssistsInGame($this->assistRepository->findTeamAssistsInGame($gameId, $game->getLoserTeam()->getId()))
        );
    }

    public function getTeamAssistsInGame($ass): array
    {
        $assists = [];
        foreach ($ass as $assist) {
            $assists[] = new GetAssistInfoDto(
                $assist->getId(),
                new GetPlayerNameDto(
                    $assist->getPlayer()->getId(),
                    $assist->getPlayer()->getName() . ' ' . $assist->getPlayer()->getSurname()
                )
            );
        }
        return $assists;
    }
}