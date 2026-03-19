<?php

namespace App\Controller\Admin;

use App\Entity\TraductionOeuvre;
use App\Form\TraductionOeuvreType;
use App\Entity\Oeuvre;
use App\Form\OeuvreType;
use App\Repository\LangueRepository;
use App\Repository\OeuvreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/oeuvre')]
final class OeuvreController extends AbstractController
{
    #[Route(name: 'app_admin_oeuvre_index', methods: ['GET'])]
    public function index(OeuvreRepository $oeuvreRepository): Response
    {
        return $this->render('admin/oeuvre/index.html.twig', [
            'oeuvres' => $oeuvreRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_oeuvre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $oeuvre = new Oeuvre();
        $form = $this->createForm(OeuvreType::class, $oeuvre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($oeuvre);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_oeuvre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/oeuvre/new.html.twig', [
            'oeuvre' => $oeuvre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_oeuvre_show', methods: ['GET'])]
    public function show(Oeuvre $oeuvre): Response
    {
        return $this->render('admin/oeuvre/show.html.twig', [
            'oeuvre' => $oeuvre,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_oeuvre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Oeuvre $oeuvre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OeuvreType::class, $oeuvre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_oeuvre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/oeuvre/edit.html.twig', [
            'oeuvre' => $oeuvre,
            'form' => $form,
        ]);
    }

//TODO deplacer dans controller trad
    #[Route('/{id}/traductions/ajouter/{langueCode}', name: 'app_admin_oeuvre_traduction_new', methods: ['GET', 'POST'])]
    public function ajouterTraduction(Request $request,Oeuvre $oeuvre,string $langueCode,LangueRepository $langueRepository,EntityManagerInterface $entityManager): Response 
    {
        $langue = $langueRepository->findOneBy(['code' => $langueCode]);
        
        $traduction = new TraductionOeuvre();
        $traduction->setOeuvre($oeuvre);
        $traduction->setLangue($langue);

        $form = $this->createForm(TraductionOeuvreType::class, $traduction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($traduction);
            $entityManager->flush();
            return $this->redirectToRoute('app_admin_oeuvre_traductions', ['id' => $oeuvre->getId()]);
        }

        return $this->render('admin/oeuvre/traduction_form.html.twig', [
            'oeuvre' => $oeuvre,
            'langue' => $langue,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/traductions/modifier/{tradId}', name: 'app_admin_oeuvre_traduction_edit', methods: ['GET', 'POST'])]
    public function modifierTraduction(Request $request,Oeuvre $oeuvre,int $tradId,EntityManagerInterface $entityManager): Response 
    {
        $traduction = $entityManager->getRepository(TraductionOeuvre::class)->find($tradId);

        $form = $this->createForm(TraductionOeuvreType::class, $traduction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_admin_oeuvre_traductions', ['id' => $oeuvre->getId()]);
        }

        return $this->render('admin/oeuvre/traduction_form.html.twig', [
            'oeuvre' => $oeuvre,
            'langue' => $traduction->getLangue(),
            'form' => $form,
        ]);
    }

    #[Route('/{id}/traductions', name: 'app_admin_oeuvre_traductions', methods: ['GET'])]
    public function traductions(Oeuvre $oeuvre,LangueRepository $langueRepository): Response 
    {
        $langues = $langueRepository->findAll();

        return $this->render('admin/oeuvre/traductions.html.twig', [
            'oeuvre' => $oeuvre,
            'langues' => $langues,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_oeuvre_delete', methods: ['POST'])]
    public function delete(Request $request, Oeuvre $oeuvre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$oeuvre->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($oeuvre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_oeuvre_index', [], Response::HTTP_SEE_OTHER);
    }
}
