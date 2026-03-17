<?php

namespace App\Controller\Admin;

use App\Entity\Emplacement;
use App\Form\EmplacementType;
use App\Repository\EmplacementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/emplacement')]
final class EmplacementController extends AbstractController
{
    #[Route(name: 'app_admin_emplacement_index', methods: ['GET'])]
    public function index(EmplacementRepository $emplacementRepository): Response
    {
        return $this->render('admin/emplacement/index.html.twig', [
            'emplacements' => $emplacementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_emplacement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $emplacement = new Emplacement();
        $form = $this->createForm(EmplacementType::class, $emplacement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($emplacement);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_emplacement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/emplacement/new.html.twig', [
            'emplacement' => $emplacement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_emplacement_show', methods: ['GET'])]
    public function show(Emplacement $emplacement): Response
    {
        return $this->render('admin/emplacement/show.html.twig', [
            'emplacement' => $emplacement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_emplacement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Emplacement $emplacement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EmplacementType::class, $emplacement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_emplacement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/emplacement/edit.html.twig', [
            'emplacement' => $emplacement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_emplacement_delete', methods: ['POST'])]
    public function delete(Request $request, Emplacement $emplacement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$emplacement->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($emplacement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_emplacement_index', [], Response::HTTP_SEE_OTHER);
    }
}
