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

    #[Route('/test/artiste/{id}/count', name: 'test_artiste_count')]
    public function testArtisteCount(int $id, ArtisteRepository $artisteRepository): Response
    {
        $result = $artisteRepository->findWithNbOeuvres($id);
        
        if (!$result) {
            return new Response('Artiste non trouvé');
        }
        
        $artiste = $result[0];  // L'objet Artiste
        $nbOeuvres = $result['nbOeuvres'];  // Le nombre d'œuvres
        
        $html = '<h1>' . $artiste->getNom() . ' ' . $artiste->getPrenom() . '</h1>';
        $html .= '<p>Nombre d\'œuvres : ' . $nbOeuvres . '</p>';
        
        return new Response($html);
    }

    #[Route('/test/exposition/{id}/artistes', name: 'test_exposition_artistes')]
    public function testExpositionArtistes(int $id, ArtisteRepository $artisteRepository): Response
    {
        $artistes = $artisteRepository->findByExposition($id);
        
        if (empty($artistes)) {
            return new Response('Aucun artiste trouvé pour cette exposition');
        }
        
        $html = '<h1>Artistes de l\'exposition</h1>';
        $html .= '<ul>';
        
        foreach ($artistes as $artiste) {
            $html .= '<li>' . $artiste->getNom() . ' ' . $artiste->getPrenom() . '</li>';
        }
        
        $html .= '</ul>';
        
        return new Response($html);
    }
}