<?php

namespace App\Controller\Admin;

use App\Repository\EmplacementRepository;
use App\Repository\ExpositionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PlanController extends AbstractController
{
    #[Route('/admin/plan', name: 'app_admin_plan')]
    public function index(ExpositionRepository $expositionRepository,EmplacementRepository $emplacementRepository): Response 
    {
        $exposition = $expositionRepository->findCurrent();

        if (!$exposition) {
            return $this->render('admin/plan/index.html.twig', [
                'exposition' => null,
                'emplacements' => [],
            ]);
        }

        $emplacements = $emplacementRepository->findBy(['exposition' => $exposition]);

        return $this->render('admin/plan/index.html.twig', [
            'exposition' => $exposition,
            'emplacements' => $emplacements,
        ]);
    }
}