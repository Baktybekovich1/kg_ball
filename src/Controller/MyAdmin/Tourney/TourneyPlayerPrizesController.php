<?php

namespace App\Controller\MyAdmin\Tourney;

use App\Dto\Prizes\PlayerPrizes\SetTourneyPlayerPrizesDto;
use App\Repository\GoalRepository;
use App\Repository\PlayerRepository;
use App\Repository\TourneyPlayerPrizesRepository;
use App\Repository\TourneyRepository;
use App\Service\Tourney\PlayerPrizes\TourneyPlayerPrizesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Tourney Player Prizes')]
class TourneyPlayerPrizesController extends AbstractController
{
    public function __construct(
//        private readonly TourneyPlayerPrizesRepository $tourneyPlayerPrizesRepository,
//        private readonly GoalRepository                $goalRepository,
//        private readonly TourneyRepository             $tourneyRepository,
//        private readonly PlayerRepository              $playerRepository,
        private readonly TourneyPlayerPrizesService $tourneyPlayerPrizesService,
    )
    {
    }

    #[Route(path: '/player/prizes/add', name: 'app_player_prizes', methods: ['POST'])]
    public function player_prizes_add(#[MapRequestPayload] SetTourneyPlayerPrizesDto $dto): JsonResponse
    {
        return $this->json($this->tourneyPlayerPrizesService->add($dto));
    }


}