<?php

namespace App\Controller\Admin;

use App\Entity\Employe;
use App\Form\EmployeType;
use App\Repository\EmployeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\ByteString;

#[IsGranted('ROLE_ADMIN')]
#[Route('/admin/employe')]
final class EmployeController extends AbstractController
{
    #[Route(name: 'app_admin_employe_index', methods: ['GET'])]
    public function index(EmployeRepository $employeRepository): Response
    {
        return $this->render('admin/employe/index.html.twig', [
            'employes' => $employeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_employe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $employe = new Employe();
        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hashed = $passwordHasher->hashPassword($employe, $employe->getMdp());
            $employe->setMdp($hashed);

            $entityManager->persist($employe);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_employe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/employe/new.html.twig', [
            'employe' => $employe,
            'form' => $form,
        ]);
    }

    #[Route('/generate-password', name: 'app_new_password')]
    public function generatePassword() {
        return new JsonResponse([
            'password' => ByteString::fromRandom(8)->toString(),
        ]);
    }

    #[Route('/{id}', name: 'app_admin_employe_show', methods: ['GET'])]
    public function show(Employe $employe): Response
    {
        return $this->render('admin/employe/show.html.twig', [
            'employe' => $employe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_employe_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Employe $employe,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher
        ): Response
    {
        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hashed = $passwordHasher->hashPassword($employe, $employe->getMdp());
            $employe->setMdp($hashed);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_employe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/employe/edit.html.twig', [
            'employe' => $employe,
            'form' => $form,
        ]);
    }
    

    #[Route('/{id}', name: 'app_admin_employe_delete', methods: ['POST'])]
    public function delete(Request $request, Employe $employe, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employe->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($employe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_employe_index', [], Response::HTTP_SEE_OTHER);
    }
}
