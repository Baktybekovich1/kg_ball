<?php

namespace App\Controller;

use App\Classes\Player;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    #[Route('/index', name: 'app_index')]
    public function index(): JsonResponse
    {
        return $this->json['awdwd'];
    }
}
