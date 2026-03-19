<?php

namespace App\Controller;

use App\Repository\ExpositionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class GlobalController extends AbstractController
{
    
    #[Route('/', name: 'app_public')]
    public function public(ExpositionRepository $expositionRepository,): Response
    {
        $exposition = $expositionRepository->findCurrent();
        $futurExpo = $expositionRepository->findNoCurrent();

        return $this->render('public/index.html.twig', [
            'langues' => null,
            'exposition' => $exposition,
            'futurExpo' => $futurExpo,
        ]);
    }
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/admin', name: 'app_admin')]
    public function admin(ExpositionRepository $expositionRepository): Response
    {
        $expoCourante = $expositionRepository->findCurrent();
        $expoAVenir = $expositionRepository->findNext();
        return $this->render('admin/index.html.twig', [
            'expoCourante' => $expoCourante,
            'expoAVenir' => $expoAVenir,
        ]);
    }


}
