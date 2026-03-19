<?php

namespace App\Controller\Admin;

use App\Entity\TraductionArtiste;
use App\Form\TraductionArtisteType;
use App\Repository\LangueRepository;
use App\Entity\Artiste;
use App\Form\ArtisteType;
use App\Repository\ArtisteRepository;
use App\Repository\OeuvreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/artiste')]
final class ArtisteController extends AbstractController
{
    #[Route(name: 'app_admin_artiste_index', methods: ['GET'])]
    public function index(ArtisteRepository $artisteRepository): Response
    {
        return $this->render('admin/artiste/index.html.twig', [
            'artistes' => $artisteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_artiste_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $artiste = new Artiste();
        $form = $this->createForm(ArtisteType::class, $artiste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($artiste);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_artiste_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/artiste/new.html.twig', [
            'artiste' => $artiste,
            'form' => $form,
        ]);
    }

    #[Route('/associer', name: 'app_admin_artiste_associer')]
    public function associer(Request $request, ArtisteRepository $artisteRepository, OeuvreRepository   $oeuvreRepository, EntityManagerInterface $entityManager): Response
    {
        $artistes = $artisteRepository->findAll();
        $oeuvres = $oeuvreRepository->findAll();

        if($request->isMethod('POST')) {
            $oeuvreId = $request->request->get('oeuvre');
            $artisteId = $request->request->get('artiste');

            $oeuvre = $oeuvreRepository->find($oeuvreId);
            $artiste = $artisteRepository->find($artisteId);

            if($oeuvre && $artiste) {
                $oeuvre->setArtiste($artiste);
                $entityManager->flush();
                return $this->redirectToRoute('app_admin_artiste_index');
            }
        }
        return $this->render('admin/artiste/associer.html.twig', [
            'artistes' => $artistes,
            'oeuvres' => $oeuvres,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_artiste_show', methods: ['GET'])]
    public function show(Artiste $artiste): Response
    {
        return $this->render('admin/artiste/show.html.twig', [
            'artiste' => $artiste,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_artiste_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Artiste $artiste, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ArtisteType::class, $artiste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_artiste_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/artiste/edit.html.twig', [
            'artiste' => $artiste,
            'form' => $form,
        ]);
    }


// TODO decaler dans controler trad
    #[Route('/{id}/traductions', name: 'app_admin_artiste_traductions', methods: ['GET'])]
    public function traductions(Artiste $artiste,LangueRepository $langueRepository): Response 
    {
        $langues = $langueRepository->findAll();

        return $this->render('admin/artiste/traductions.html.twig', [
            'artiste' => $artiste,
            'langues' => $langues,
        ]);
    }

    #[Route('/{id}/traductions/ajouter/{langueCode}', name: 'app_admin_artiste_traduction_new', methods: ['GET', 'POST'])]
    public function ajouterTraduction(Request $request, Artiste $artiste, string $langueCode,
        LangueRepository $langueRepository, EntityManagerInterface $entityManager): Response 
    {
        $langue = $langueRepository->findOneBy(['code' => $langueCode]);

        $traduction = new TraductionArtiste();
        $traduction->setArtiste($artiste);
        $traduction->setLangue($langue);

        $form = $this->createForm(TraductionArtisteType::class, $traduction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($traduction);
            $entityManager->flush();
            return $this->redirectToRoute('app_admin_artiste_traductions', ['id' => $artiste->getId()]);
        }

        return $this->render('admin/artiste/traduction_form.html.twig', [
            'artiste' => $artiste,
            'langue' => $langue,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/traductions/modifier/{tradId}', name: 'app_admin_artiste_traduction_edit', methods: ['GET', 'POST'])]
    public function modifierTraduction(Request $request, Artiste $artiste, int $tradId,         EntityManagerInterface $entityManager): Response 
    {
        $traduction = $entityManager->getRepository(TraductionArtiste::class)->find($tradId);

        $form = $this->createForm(TraductionArtisteType::class, $traduction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_admin_artiste_traductions', ['id' => $artiste->getId()]);
        }

        return $this->render('admin/artiste/traduction_form.html.twig', [
            'artiste' => $artiste,
            'langue' => $traduction->getLangue(),
            'form' => $form,
        ]);
    }
/////////////////////////////
    #[Route('/{id}', name: 'app_admin_artiste_delete', methods: ['POST'])]
    public function delete(Request $request, Artiste $artiste, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$artiste->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($artiste);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_artiste_index', [], Response::HTTP_SEE_OTHER);
    }

    
}