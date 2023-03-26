<?php

namespace App\Controller;

use App\Repository\FavoriteRepository;
use App\Repository\FruitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavoriteController extends AbstractController
{

    #[Route('/favorites', name: 'index_favorite', methods: 'GET')]
    public function index(FruitRepository $fruitRepository): Response
    {
        return $this->render('favorite.html.twig', [
            'fruits' => $fruitRepository->findAll(),
        ]);
    }

    #[Route('/favorites/list', name: 'list_favorite', methods: 'GET')]
    public function list(
        FruitRepository $fruitRepository,
        FavoriteRepository $favoriteRepository
    ): JsonResponse {
        $fruits = $fruitRepository->transformFavorites($favoriteRepository);

        return new JsonResponse($fruits);
    }

    #[Route('/favorites', name: 'add_favorite', methods: 'POST')]
    public function store(
        Request $request,
        FavoriteRepository $favoriteRepository
    ): JsonResponse {
        $data = $request->getContent();
        $data = json_decode($data, true);
        $fruitId = $data['fruitId'] ?? '';
        $result = $favoriteRepository->addFavorite($fruitId);

        if (! $result) {
            return new JsonResponse([], 400);
        }

        return new JsonResponse($result, 200);
    }

    #[Route('/favorites', name: 'remove_favorite', methods: ['DELETE'])]
    public function remove(
        Request $request,
        FavoriteRepository $favoriteRepository
    ): JsonResponse {
        $fruitId = $request->get('fruitId') ?? '';
        $result = $favoriteRepository->remove($fruitId);
        $status = $result ? 200 : 400;

        return new JsonResponse([], $status);
    }
}
