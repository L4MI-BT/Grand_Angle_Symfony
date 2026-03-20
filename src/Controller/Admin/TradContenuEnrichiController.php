<?php

namespace App\Controller\Admin;

use App\Entity\ContenuEnrichi;
use App\Entity\TraductionContenuEnrichi;
use App\Form\TraductionContenuEnrichiType;
use App\Repository\LangueRepository;
use App\Repository\OeuvreRepository;
use App\Repository\TraductionContenuEnrichiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/contenu_enrichi/traduction')]
final class TradContenuEnrichiController extends AbstractController
{
    #[Route('/{id}', name: 'app_admin_contenu_enrichi_traductions', methods: ['GET'])]
    public function gererTraductions(
        ContenuEnrichi $contenuEnrichi, 
        LangueRepository $langueRepository,
        ): Response
    {
        $langues = $langueRepository->findAll();

        return $this->render('admin/trad_contenu_enrichi/traductions.html.twig',[
            'contenus' => $contenuEnrichi,
            'langues' => $langues,
        ]);
    }

    #[Route('/{id}/ajouter/{langueCode}', name: 'app_admin_contenu_enrichi_traduction_new', methods: ['GET', 'POST'])]
    public function ajouterTraduction(
        Request $request,
        ContenuEnrichi $contenuEnrichi,
        string $langueCode,
        LangueRepository $langueRepository,
        EntityManagerInterface $entityManager
        ): Response
    {
        $langue = $langueRepository->findOneBy(['code' => $langueCode]);

        $traduction = new TraductionContenuEnrichi();
        $traduction->setContenuEnrichi($contenuEnrichi);
        $traduction->setLangue($langue);

        $form = $this->createForm(TraductionContenuEnrichiType::class, $traduction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($traduction);
            $entityManager->flush();
            return $this->redirectToRoute('app_admin_contenu_enrichi_traductions');
        }

        return $this->render('admin/trad_contenu_enrichi/traduction_form.html.twig', [
            'contenus' => $contenuEnrichi,
            'langue' => $langue,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/modifier/{langueCode}', name: 'app_admin_contenu_enrichi_traduction_edit', methods: ['GET', 'POST'])]
    public function modifierTraduction(
        Request $request,
        ContenuEnrichi $contenuEnrichi,
        string $langueCode,
        TraductionContenuEnrichiRepository $traductionContenuEnrichiRepository,
        LangueRepository $langueRepository,
        EntityManagerInterface $entityManager
        ): Response
    {
        $langue = $langueRepository->findOneBy(['code' => $langueCode]);
        $traduction = $traductionContenuEnrichiRepository->findTraductionByContenuAndLangue($contenuEnrichi, $langue);

        $form = $this->createForm(TraductionContenuEnrichiType::class, $traduction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_admin_contenu_enrichi_traductions', ['id' => $contenuEnrichi->getId()]);
        }

        return $this->render('admin/trad_contenu_enrichi/traduction_form.html.twig', [
            'contenus' => $contenuEnrichi,
            'langue' => $traduction->getLangue(),
            'form' => $form,
        ]);
    }
}
