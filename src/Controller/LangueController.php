<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LangueController extends AbstractController
{

    // Method qui permet de changer les valeurs des sessions de langue. 
    // On recupère l'Id de la langue dans l'url via _GET (passer par le button dropdown), puis on vérifie si la langue est dans la bdd, puis on récupère les valeurs de l'idLangue, le code, et l'img puis on met à jour les sessions avec ces valeurs.
    #[Route('/langue', name: 'app_langue')]
    public function changeLangue(): Response
    {
        return $this->render('langue/index.html.twig', [
            'controller_name' => 'LangueController',
        ]);
    }
}
