<?php

namespace App\Controller\MyAdmin\Assist;

use App\Dto\Assist\SetAssistDto;
use App\Service\Assist\AdminAssistService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Admin api for Assist')]
class AssistController extends AbstractController
{
    public function __construct(
        private readonly AdminAssistService $adminAssistService
    )
    {
    }

    #[Route(path: '/add', name: 'app_admin_assist_add', methods: ['POST'])]
    public function add(#[MapRequestPayload] SetAssistDto $dto): JsonResponse
    {
        return $this->json($this->adminAssistService->add($dto));
    }

    #[Route(path: '/remove/{assistId}', name: 'app_admin_assist_remove', methods: ['DELETE'])]
    public function remove(Request $request): JsonResponse
    {
        return $this->json($this->adminAssistService->remove($request->get('assistId')));
    }

    #[Route(path: '/edit/{assistId}', name: 'app_admin_assist_edit', methods: ['PATCH'])]
    public function edit(#[MapRequestPayload] SetAssistDto $dto, Request $request): JsonResponse
    {
        return $this->json($this->adminAssistService->edit($dto, $request->get('assistId')));
    }

}