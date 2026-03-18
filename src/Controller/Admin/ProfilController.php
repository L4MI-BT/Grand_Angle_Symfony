<?php

namespace App\Controller\Admin;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


final class ProfilController extends AbstractController
{
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/admin/profil', name: 'app_admin_profil')]
    public function index(Request $request, UserPasswordHasherInterface $hasher, EntityManagerInterface $em): Response
    {
        /** @var \App\Entity\Employe $employe */
        $employe = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ancienMdp = $form->get('ancienMdp')->getData();
            $nouveauMdp = $form->get('nouveauMdp')->getData();
            $confirmMdp = $form->get('confirmMdp')->getData();

            // Vérifier l'ancien mot de passe
            if (!$hasher->isPasswordValid($employe, $ancienMdp)) {
                $this->addFlash('danger', 'Ancien mot de passe incorrect.');
                return $this->redirectToRoute('app_admin_profil');
            }

            // Vérifier la confirmation
            if ($nouveauMdp !== $confirmMdp) {
                $this->addFlash('danger', 'Les nouveaux mots de passe ne correspondent pas.');
                return $this->redirectToRoute('app_admin_profil');
            }

            $employe->setMdp($hasher->hashPassword($employe, $nouveauMdp));
            $em->flush();

            $this->addFlash('success', 'Mot de passe modifié avec succès.');
            return $this->redirectToRoute('app_admin_profil');
        }

        return $this->render('admin/profil/index.html.twig', [
            'form' => $form,
        ]);
    }
}
