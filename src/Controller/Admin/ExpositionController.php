<?php

namespace App\Controller\Admin;

use App\Entity\Exposition;
use App\Form\ExpositionType;
use App\Entity\TraductionExpo;
use App\Form\TraductionExpoType;
use App\Repository\LangueRepository;
use App\Repository\EmplacementRepository;
use App\Repository\ExpositionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/exposition')]
final class ExpositionController extends AbstractController
{
    #[Route(name: 'app_admin_exposition_index', methods: ['GET'])]
    public function index(ExpositionRepository $expositionRepository): Response
    {
        return $this->render('admin/exposition/index.html.twig', [
            'expositions' => $expositionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_exposition_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $exposition = new Exposition();
        $form = $this->createForm(ExpositionType::class, $exposition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($exposition);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_exposition_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/exposition/new.html.twig', [
            'exposition' => $exposition,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_exposition_show', methods: ['GET'])]
    public function show(Exposition $exposition, EmplacementRepository $emplacementRepository): Response
    {
        $emplacements = $emplacementRepository->findBy(['exposition' => $exposition]);
        return $this->render('admin/exposition/show.html.twig', [
            'exposition' => $exposition,
            'emplacements' => $emplacements,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_exposition_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Exposition $exposition, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ExpositionType::class, $exposition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_admin_exposition_index', [], Response::HTTP_SEE_OTHER);
        }

        // Gestion des étapes séparément
        if ($request->isMethod('POST') && $request->request->has('etapes') || 
            $request->isMethod('POST') && !$form->isSubmitted()) {
            
            $etapesData = $request->request->all('etapes') ?? [];
            foreach ($exposition->getEtapes() as $etape) {
                $estComplete = isset($etapesData[$etape->getId()]);
                $etape->setEstComplete($estComplete);
            }
            $entityManager->flush();
            return $this->redirectToRoute('app_admin_exposition_show', ['id' => $exposition->getId(),'_fragment'=>'CycleDeVie']);
        }

        return $this->render('admin/exposition/edit.html.twig', [
            'exposition' => $exposition,
            'form' => $form,
        ]);
    }
    
//TODO modifier dans un controller tarduction

    #[Route('/{id}/traductions', name: 'app_admin_exposition_traductions', methods: ['GET'])]
    public function traductions(
        Exposition $exposition,
        LangueRepository $langueRepository
    ): Response {
        $langues = $langueRepository->findAll();

        return $this->render('admin/exposition/traductions.html.twig', [
            'exposition' => $exposition,
            'langues' => $langues,
        ]);
    }

    #[Route('/{id}/traductions/ajouter/{langueCode}', name: 'app_admin_exposition_traduction_new', methods: ['GET', 'POST'])]
    public function ajouterTraduction(
        Request $request,
        Exposition $exposition,
        string $langueCode,
        LangueRepository $langueRepository,
        EntityManagerInterface $entityManager
    ): Response {
        $langue = $langueRepository->findOneBy(['code' => $langueCode]);

        $traduction = new TraductionExpo();
        $traduction->setExposition($exposition);
        $traduction->setLangue($langue);

        $form = $this->createForm(TraductionExpoType::class, $traduction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($traduction);
            $entityManager->flush();
            return $this->redirectToRoute('app_admin_exposition_traductions', ['id' => $exposition->getId()]);
        }

        return $this->render('admin/exposition/traduction_form.html.twig', [
            'exposition' => $exposition,
            'langue' => $langue,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/traductions/modifier/{tradId}', name: 'app_admin_exposition_traduction_edit', methods: ['GET', 'POST'])]
    public function modifierTraduction(
        Request $request,
        Exposition $exposition,
        int $tradId,
        EntityManagerInterface $entityManager
    ): Response {
        $traduction = $entityManager->getRepository(TraductionExpo::class)->find($tradId);

        $form = $this->createForm(TraductionExpoType::class, $traduction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_admin_exposition_traductions', ['id' => $exposition->getId()]);
        }

        return $this->render('admin/exposition/traduction_form.html.twig', [
            'exposition' => $exposition,
            'langue' => $traduction->getLangue(),
            'form' => $form,
        ]);
    }
    
////////////////////////

    #[Route('/{id}', name: 'app_admin_exposition_delete', methods: ['POST'])]
    public function delete(Request $request, Exposition $exposition, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exposition->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($exposition);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_exposition_index', [], Response::HTTP_SEE_OTHER);
    }
}
