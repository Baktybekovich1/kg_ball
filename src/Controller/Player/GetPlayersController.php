<?php

namespace App\Controller\Player;

use App\Repository\PlayerRepository;
use App\Service\Player\GetPlayerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class GetPlayersController extends AbstractController
{
    public function __construct(private GetPlayerService $getPlayerService, private PlayerRepository $playerRepository)
    {
    }

    #[Route('/player/personal_card/{id}', name: 'player_personal_cards')]
    public function personal_card(Request $request): JsonResponse
    {
        return $this->json(['player' => $this
            ->getPlayerService
            ->GetPlayersPersonalCard($request->get('id'))]);
    }

    #[Route('/players/list', name: 'players_list')]
    public function players_list(Request $request): JsonResponse
    {
        return $this->json(['players' => $this
            ->getPlayerService
            ->getPlayersList()]);
    }

    #[Route('/player/statistic/{id}', name: 'player_statistic')]
    public function player_statistic(Request $request): JsonResponse
    {
        return $this->json(['player' => $this
            ->getPlayerService
            ->getPlayerStatistic($request->get('id'))]);
    }


}