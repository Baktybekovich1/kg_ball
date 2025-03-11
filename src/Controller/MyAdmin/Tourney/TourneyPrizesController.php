<?php

namespace App\Controller\MyAdmin\Tourney;

use App\Dto\Tourney\TourneyPrizes\SetTourneyPrizesDto;
use App\Service\Tourney\TourneyPrizes\TourneyPrizesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class TourneyPrizesController extends AbstractController
{
    public function __construct(private TourneyPrizesService $prizesService)
    {
    }

    #[Route(path: '/prizes/add', name: 'app_admin_tourney_prizes', methods: ['POST'])]
    public function prizes_add(#[MapRequestPayload] SetTourneyPrizesDto $dto): JsonResponse
    {
        return $this->json($this->prizesService->add($dto));
    }

    #[Route(path: '/prizes/remove/{id}', name: 'app_admin_tourney_prizes_remove', methods: ['DELETE'])]
    public function prizes_remove(Request $request): JsonResponse
    {
        return $this->json($this->prizesService->remove($request->get('id')));
    }

    #[Route(path: '/prizes/edit/{id}', name: 'app_admin_tourney_prizes_edit', methods: ['PATCH'])]
    public function prizes_edit(#[MapRequestPayload] SetTourneyPrizesDto $dto,Request $request): JsonResponse
    {
        return $this->json($this->prizesService->edit($dto,$request->get('id')));
    }

}