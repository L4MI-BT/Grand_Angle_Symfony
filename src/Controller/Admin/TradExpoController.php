<?php

namespace App\Controller\Admin;

use App\Entity\Exposition;
use App\Entity\TraductionExpo;
use App\Form\TraductionExpoType;
use App\Repository\LangueRepository;
use App\Repository\TraductionExpoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/exposition/traduction')]
final class TradExpoController extends AbstractController
{
    #[Route('/{id}', name: 'app_admin_exposition_traductions', methods: ['GET'])]
    public function traductions(
        Exposition $exposition,
        LangueRepository $langueRepository
    ): Response {
        $langues = $langueRepository->findAll();

        return $this->render('admin/trad_expo/traductions.html.twig', [
            'exposition' => $exposition,
            'langues' => $langues,
        ]);
    }

    #[Route('/{id}/ajouter/{langueCode}', name: 'app_admin_exposition_traduction_new', methods: ['GET', 'POST'])]
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

        return $this->render('admin/trad_expo/traduction_form.html.twig', [
            'exposition' => $exposition,
            'langue' => $langue,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/modifier/{langueCode}', name: 'app_admin_exposition_traduction_edit', methods: ['GET', 'POST'])]
    public function modifierTraduction(
        Request $request,
        Exposition $exposition,
        string $langueCode,
        EntityManagerInterface $entityManager,
        TraductionExpoRepository $traductionExpoRepository,
        LangueRepository $langueRepository
    ): Response {

        $langue = $langueRepository->findOneBy(['code' => $langueCode]);
        $traduction = $traductionExpoRepository->findTraductionByExpoAndLangue($exposition, $langue);

        $form = $this->createForm(TraductionExpoType::class, $traduction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_admin_exposition_traductions', ['id' => $exposition->getId()]);
        }

        return $this->render('admin/trad_expo/traduction_form.html.twig', [
            'exposition' => $exposition,
            'langue' => $traduction->getLangue(),
            'form' => $form,
        ]);
    }



}
