<?php

namespace App\Controller;

use App\Repository\OeuvreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OeuvreController extends AbstractController
{
    #[Route('/oeuvre/{id}', name: 'oeuvre_show')]
    public function show(int $id, OeuvreRepository $oeuvreRepository): Response
    {
        // Récupère l'œuvre avec toutes ses relations
        $oeuvre = $oeuvreRepository->findWithAllRelations($id);
        
        if (!$oeuvre) {
            throw $this->createNotFoundException('Œuvre non trouvée');
        }
        
        return $this->render('public/oeuvre/show.html.twig', [
            'oeuvre' => $oeuvre,
        ]);
    }
}