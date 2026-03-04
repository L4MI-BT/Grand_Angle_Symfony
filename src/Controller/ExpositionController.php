<?php

namespace App\Controller;

use App\Repository\ExpositionRepository;
use App\Repository\OeuvreRepository;
use App\Repository\ArtisteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ExpositionController extends AbstractController
{
    #[Route('/exposition', name: 'exposition_current')]
    public function current(
        ExpositionRepository $expositionRepository,
        OeuvreRepository $oeuvreRepository,
        ArtisteRepository $artisteRepository,
        EntityManagerInterface $em
    ): Response {
        $exposition = $expositionRepository->findCurrent();
        
        if (!$exposition) {
            return $this->render('public/exposition/no_current.html.twig');
        }
        
        $oeuvres = $oeuvreRepository->findByExposition($exposition->getId());
        
        // Récupérer les artistes de cette exposition
        $artistes = $artisteRepository->findByExposition($exposition->getId());
        
        // Récupérer les horaires (expo ou config)
        $horaires = $exposition->getHoraires();
        
        if (!$horaires) {
            $config = $em->getRepository(\App\Entity\Configuration::class)
                ->findOneBy(['cle' => 'horairesCentre']);
            
            $horaires = $config ? $config->getValeur() : 'Horaires non disponibles';
        }
        
        return $this->render('public/exposition/current.html.twig', [
            'exposition' => $exposition,
            'oeuvres' => $oeuvres,
            'artistes' => $artistes,
            'horaires' => $horaires,
        ]);
    }
}