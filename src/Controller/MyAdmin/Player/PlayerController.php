<?php

namespace App\Controller\MyAdmin\Player;

use App\Dto\Player\SetPlayerDto;
use App\Repository\PlayerRepository;
use App\Service\Player\AdminPlayerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Admin api for Player')]

class PlayerController extends AbstractController
{
    public function __construct(
        private readonly AdminPlayerService $adminPlayerService
    )
    {
    }

    #[Route(path: '/player/add', name: 'app_add_new_player', methods: ['POST'])]
    public function add_player(#[MapRequestPayload] SetPlayerDto $dto): JsonResponse
    {
        return $this->json($this->adminPlayerService->setPlayer($dto->teamId, $dto->name, $dto->surname, $dto->birthday, $dto->position, $dto->img));
    }

    #[Route(path: '/player/remove/{id}', name: 'app_admin_remove_player', methods: ['DELETE'])]
    public function removePlayer(Request $request): JsonResponse
    {
        return $this->json($this->adminPlayerService->removePlayer($request->get('id')));
    }
}