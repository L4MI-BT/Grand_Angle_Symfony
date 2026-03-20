<?php

namespace App\Controller\Admin;

use App\Entity\ContenuEnrichi;
use App\Entity\Oeuvre;
use App\Entity\TraductionContenuEnrichi;
use App\Form\ContenuEnrichiType;
use App\Form\TraductionContenuEnrichiType;
use App\Repository\ContenuEnrichiRepository;
use App\Repository\LangueRepository;
use App\Repository\OeuvreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/contenu_enrichi')]
final class ContenuEnrichiController extends AbstractController
{
    #[Route(name: 'app_admin_contenu_enrichi_index', methods: ['GET'])]
    public function index(ContenuEnrichiRepository $contenuEnrichiRepository): Response
    {
        return $this->render('admin/contenu_enrichi/index.html.twig', [
            'contenu_enrichis' => $contenuEnrichiRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_contenu_enrichi_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contenuEnrichi = new ContenuEnrichi();
        $form = $this->createForm(ContenuEnrichiType::class, $contenuEnrichi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contenuEnrichi);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_contenu_enrichi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/contenu_enrichi/new.html.twig', [
            'contenu_enrichi' => $contenuEnrichi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_contenu_enrichi_show', methods: ['GET'])]
    public function show(ContenuEnrichi $contenuEnrichi): Response
    {
        return $this->render('admin/contenu_enrichi/show.html.twig', [
            'contenu_enrichi' => $contenuEnrichi,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_contenu_enrichi_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ContenuEnrichi $contenuEnrichi, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContenuEnrichiType::class, $contenuEnrichi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_contenu_enrichi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/contenu_enrichi/edit.html.twig', [
            'contenu_enrichi' => $contenuEnrichi,
            'form' => $form,
        ]);
    }

    #[Route('/oeuvre/{id}', name:'app_admin_contenu_enrichi_oeuvre')]
    public function showByOeuvre(ContenuEnrichiRepository $contenuEnrichiRepository, Oeuvre $oeuvre)
    {
        $contenuEnrichi = $contenuEnrichiRepository->findBy(['oeuvre'=>$oeuvre]);
        
        return $this->render('admin/contenu_enrichi/show_per_oeuvre.html.twig',[
            'contenus' => $contenuEnrichi,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_contenu_enrichi_delete', methods: ['POST'])]
    public function delete(Request $request, ContenuEnrichi $contenuEnrichi, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contenuEnrichi->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($contenuEnrichi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_contenu_enrichi_index', [], Response::HTTP_SEE_OTHER);
    }
}
