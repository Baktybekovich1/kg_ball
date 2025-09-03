<?php

namespace App\Controller\MyAdmin\MonthAward;

use App\Dto\MonthAward\SetMonthAwardDto;
use App\Service\MonthAward\MonthPlayerAwardEditService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Admin Month Player Award')]
class EditController extends AbstractController
{
    public function __construct(
        private readonly MonthPlayerAwardEditService $monthPlayerAwardEditService
    )
    {
    }

    #[Route(path: '/add', name: 'month_award_add', methods: ['POST'])]
    public function add(#[MapRequestPayload] SetMonthAwardDto $dto): JsonResponse
    {
        return $this->json($this->monthPlayerAwardEditService->add($dto));
    }
    #[Route(path: '/edit/{monthId}', name: 'month_award_edit', methods: ['PATCH'])]
    public function edit(#[MapRequestPayload] SetMonthAwardDto $dto, Request $request): JsonResponse
    {
        return $this->json($this->monthPlayerAwardEditService->edit($request->get('monthId'), $dto));
    }
    #[Route(path: '/remove/{monthId}', name: 'month_award_remove', methods: ['DELETE'])]
    public function remove(Request $request): JsonResponse
    {
        return $this->json($this->monthPlayerAwardEditService->remove($request->get('monthId')));
    }
}