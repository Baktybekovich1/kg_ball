<?php

namespace App\Controller\Team;

use App\Service\Team\GetTeamService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

use OpenApi\Attributes as OA;

#[OA\Tag(name:'Get api for Team')]
class GetTeamController extends AbstractController
{
    public function __construct(
        private readonly GetTeamService $getTeamService
    )
    {
    }

    /* Здесь Get запросы по командам (Team) перед путём каждого Route есть префикс /team;*/

    #[Route('/progress/{id}', name: 'app_team_progress', methods: ['GET'])]
    public function team_progress(Request $request): JsonResponse
    {
        return $this->json([$this->getTeamService->getProgress($request->get('id'))]);
    }

    #[Route('/game_info/{id}', name: 'app_team_game_info', methods: ['GET'])]
    public function team_game_info(Request $request): JsonResponse
    {
        return $this->json([$this->getTeamService->getGameInfo($request->get('id'))]);
    }

    #[Route('/squad_list/{id}', name: 'app_team_squad_list', methods: ['GET'])]
    public function team_squad_list(Request $request): JsonResponse
    {
        return $this->json(['players' => $this->getTeamService->getSquadList($request->get('id'))]);
    }

    #[Route('/game_list/{id}', name: 'app_team_game_list', methods: ['GET'])]
    public function team_game_list(Request $request): JsonResponse
    {
        return $this->json(['games' => $this->getTeamService->getGameList($request->get('id'))]);
    }


    # Лучшие игроки команды 
    #[Route('/best_players/{id}', name: 'app_team_best_players', methods: ['GET'])]
    public function team_best_players(Request $request): JsonResponse
    {
        return $this->json(['players' => $this->getTeamService->getBestPlayers($request->get('id'))]);
    }

    #[Route('/game_statistics/{firstTeamId}/{secondTeamId}', name: 'app_team_game_statistics', methods: ['GET'])]
    public function index(Request $request): JsonResponse
    {
        return $this->json($this->getTeamService->getGameStatistics($request->get('firstTeamId'), $request->get('secondTeamId')));
    }

}