<?php

namespace App\Controller;

use App\Repository\ExpositionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

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

    #[Route('/admin', name: 'app_admin')]
    public function admin(): Response
    {
        return $this->render('admin/index.html.twig');
    }


}
