<?php

namespace App\Controller\MyAdmin\Game;

use App\Dto\Game\SetGameDto;
use App\Repository\GameRepository;
use App\Service\Game\AdminGameService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Admin api for Game')]
class GameController extends AbstractController
{
    public function __construct(private readonly AdminGameService $service)
    {
    }

    #[Route(path: '/add', name: 'app_admin_game', methods: ['POST'])]
    public function add(#[MapRequestPayload] SetGameDto $dto): JsonResponse
    {
        return $this->json($this->service->add($dto));
    }

    #[Route(path: '/remove/{gameId}', name: 'app_admin_game_remove', methods: ['DELETE'])]
    public function remove(Request $request): JsonResponse
    {
        return $this->json($this->service->remove($request->get('gameId')));
    }

    #[Route(path: '/edit/{gameId}', name: 'app_admin_game_edit', methods: ['PATCH'])]
    public function edit(#[MapRequestPayload] SetGameDto $dto, Request $request): JsonResponse
    {
        return $this->json($this->service->edit($dto, $request->get('gameId')));
    }

}