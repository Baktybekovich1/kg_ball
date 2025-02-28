<?php

namespace App\Controller\Player;

use App\Service\Player\GetPlayerService;
use OpenApi\Attributes\OpenApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

#[OA\Tag(name:'Get api for Player')]
class GetPlayerController extends AbstractController
{
    public function __construct(private readonly GetPlayerService $getPlayerService)
    {
    }

    /* Здесь Get запросы по Игрокам (Player) перед путём каждого Route есть префикс /player;*/
    #[Route('/personal_card/{id}', name: 'player_personal_cards',methods: ['GET'])]
    public function personal_card(Request $request): JsonResponse
    {
        return $this->json(['player' => $this
            ->getPlayerService
            ->GetPlayersPersonalCard($request->get('id'))]);
    }

    #[Route('/list', name: 'players_list',methods: ['GET'])]
    public function players_list(Request $request): JsonResponse
    {
        return $this->json(['players' => $this
            ->getPlayerService
            ->getPlayersList()]);
    }

    #[Route('/statistic/{id}', name: 'player_statistic',methods: ['GET'])]
    public function player_statistic(Request $request): JsonResponse
    {
        return $this->json(['player' => $this
            ->getPlayerService
            ->getPlayerStatistic($request->get('id'))]);
    }
    
    #[Route('/best_players', name: 'app_player_best_players',methods: ['GET'])]
    public function best_players(): JsonResponse
    {
        return $this->json($this->getPlayerService->getBestPlayers());
    }


}