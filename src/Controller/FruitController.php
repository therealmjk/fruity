<?php

namespace App\Controller;

use App\Repository\FavoriteRepository;
use App\Repository\FruitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FruitController extends AbstractController
{

    #[Route('/fruits', name: 'list_fruit')]
    public function index(
        Request $request,
        FruitRepository $fruitRepository,
        FavoriteRepository $favoriteRepository
    ): JsonResponse {
        $keyword = $request->get('keyword') ?? '';
        $fruits = $fruitRepository->transformAll($favoriteRepository, $keyword);

        return new JsonResponse($fruits);
    }
}
