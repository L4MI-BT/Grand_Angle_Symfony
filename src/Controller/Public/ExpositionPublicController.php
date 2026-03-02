<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class Public/ExpositionPublicController extends AbstractController
{
    #[Route('/public/exposition/public', name: 'app_public_exposition_public')]
    public function index(): Response
    {
        return $this->render('public/exposition_public/index.html.twig', [
            'controller_name' => 'Public/ExpositionPublicController',
        ]);
    }
}
