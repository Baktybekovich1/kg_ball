<?php

namespace App\Controller\TestApi;

use App\Repository\TestApiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class TestApiController extends AbstractController
{
    public function __construct(
        private readonly TestApiRepository $testApiRepository
    )
    {
    }

    #[Route(path: '/test/api/get', name: 'test_get_api', methods: ['GET'])]
    public function test_api(): JsonResponse
    {
        $apis = $this->testApiRepository->findAll();
        return $this->json($apis);
    }

}