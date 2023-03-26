<?php

namespace App\Controller;

use App\Repository\FruitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{

    #[Route('/', name: 'home')]
    public function index(FruitRepository $fruitRepository): Response
    {
        return $this->render('index.html.twig', [
            'fruits' => $fruitRepository->findAll(),
        ]);
    }
}
