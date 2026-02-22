<?php

namespace App\Controller;

use App\Repository\ArtisteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestController extends AbstractController
{
    #[Route('/test/artiste/{id}', name: 'test_artiste')]
    public function testArtiste(int $id, ArtisteRepository $artisteRepository): Response
    {
        $artiste = $artisteRepository->findWithOeuvres($id);
        
        if (!$artiste) {
            return new Response('Artiste non trouvé');
        }
        
        $html = '<h1>' . $artiste->getNom() . ' ' . $artiste->getPrenom() . '</h1>';
        $html .= '<h2>Œuvres :</h2><ul>';
        
        foreach ($artiste->getOeuvres() as $oeuvre) {
            $html .= '<li>' . $oeuvre->getTitre() . ' (' . $oeuvre->getAnneeCreation() . ')</li>';
        }
        
        $html .= '</ul>';
        
        return new Response($html);
    }
}