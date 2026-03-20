<?php

namespace App\Controller\Admin;

use App\Entity\Artiste;
use App\Entity\TraductionArtiste;
use App\Form\TraductionArtisteType;
use App\Repository\LangueRepository;
use App\Repository\TraductionArtisteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/artiste/traduction')]
final class TradArtisteController extends AbstractController
{

    #[Route('/{id}', name: 'app_admin_artiste_traductions')]
    public function traductions(Artiste $artiste,LangueRepository $langueRepository): Response
    {
        $langues = $langueRepository->findAll();

        return $this->render('admin/trad_artiste/traductions.html.twig', [
            'artiste' => $artiste,
            'langues' => $langues,
        ]);
    }

    
    #[Route('/{id}/ajouter/{langueCode}', name: 'app_admin_artiste_traduction_new', methods: ['GET', 'POST'])]
    public function ajouterTraduction(
        Request $request,
        Artiste $artiste,
        string $langueCode,
        LangueRepository $langueRepository,
        EntityManagerInterface $entityManager
        ): Response
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

        return $this->render('admin/trad_artiste/traduction_form.html.twig', [
            'artiste' => $artiste,
            'langue' => $langue,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/modifier/{langueCode}', name: 'app_admin_artiste_traduction_edit', methods: ['GET', 'POST'])]
    public function modifierTraduction(
        Request $request,
        Artiste $artiste,
        string $langueCode,
        EntityManagerInterface $entityManager,
        TraductionArtisteRepository $traductionArtisteRepository,
        LangueRepository $langueRepository,
        ): Response
    {
        $langue = $langueRepository->findOneBy(['code' => $langueCode]);
        $traduction = $traductionArtisteRepository->findTraductionByArtisteAndLangue($artiste, $langue);

        $form = $this->createForm(TraductionArtisteType::class, $traduction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_admin_artiste_traductions', ['id' => $artiste->getId()]);
        }

        return $this->render('admin/trad_artiste/traduction_form.html.twig', [
            'artiste' => $artiste,
            'langue' => $traduction->getLangue(),
            'form' => $form,
        ]);
    }
}
