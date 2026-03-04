<?php

namespace App\Controller;

use App\Repository\ArtisteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArtisteController extends AbstractController
{
    #[Route('/artiste/{id}', name: 'app_artiste')]
    public function index(ArtisteRepository $artisteRepository, int $id): Response
    {
        $artiste = $artisteRepository->findWithOeuvres($id);
        return $this->render('public/artiste/index.html.twig', [
            'artiste' => $artiste,
        ]);
    }
}
