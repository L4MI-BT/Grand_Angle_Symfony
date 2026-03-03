<?php

namespace App\Controller\Public;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ExpositionPublicController extends AbstractController
{
    #[Route('/public/exposition', name: 'app_exposition_public_list')]
    public function index(): Response
    {
        return $this->render('public/exposition_public/index.html.twig', [
            'controller_name' => 'Public/ExpositionPublicController',
        ]);
    }
}
