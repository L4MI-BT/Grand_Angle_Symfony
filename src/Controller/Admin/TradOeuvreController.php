<?php

namespace App\Controller\Admin;

use App\Entity\Oeuvre;
use App\Entity\TraductionOeuvre;
use App\Form\TraductionOeuvreType;
use App\Repository\LangueRepository;
use App\Repository\TraductionOeuvreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/oeuvre/traduction')]
final class TradOeuvreController extends AbstractController
{

    #[Route('/{id}', name: 'app_admin_oeuvre_traductions', methods: ['GET'])]
    public function traductions(Oeuvre $oeuvre,LangueRepository $langueRepository): Response
    {
        $langues = $langueRepository->findAll();

        return $this->render('admin/trad_oeuvre/traductions.html.twig', [
            'oeuvre' => $oeuvre,
            'langues' => $langues,
        ]);
    }

    #[Route('/{id}/ajouter/{langueCode}', name: 'app_admin_oeuvre_traduction_new', methods: ['GET', 'POST'])]
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

        return $this->render('admin/trad_oeuvre/traduction_form.html.twig', [
            'oeuvre' => $oeuvre,
            'langue' => $langue,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/modifier/{langueCode}', name: 'app_admin_oeuvre_traduction_edit', methods: ['GET', 'POST'])]
    public function modifierTraduction(
        Request $request,
        Oeuvre $oeuvre,
        string $langueCode,
        EntityManagerInterface $entityManager,
        TraductionOeuvreRepository $traductionOeuvreRepository,
        LangueRepository $langueRepository
    ): Response
    {
        $langue = $langueRepository->findOneBy(['code' => $langueCode]);
        $traduction = $traductionOeuvreRepository->findTraductionByOeuvreAndLangue($oeuvre, $langue);

        $form = $this->createForm(TraductionOeuvreType::class, $traduction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_admin_oeuvre_traductions', ['id' => $oeuvre->getId()]);
        }

        return $this->render('admin/trad_oeuvre/traduction_form.html.twig', [
            'oeuvre' => $oeuvre,
            'langue' => $traduction->getLangue(),
            'form' => $form,
        ]);
    }

    
}
