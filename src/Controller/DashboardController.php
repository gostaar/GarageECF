<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Form\SearchFormType;
use App\Data\SearchData;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Twig\Environment;
use App\Entity\Voiture;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    // #[Security('is_granted("ROLE_ADMIN")')]
    public function index(): Response
    {

        // Redirect to the 'user' route
        $url = $this->generateUrl('app_user_index');
        $urlvoiture = $this->generateUrl('app_voitures_index');
        // Create a link with the generated URL
        $link = '<a href="' . $url . '">Gestion des utilisateurs</a>';
        $linkvoiture = '<a href="' . $url . '">Gestion des voitures</a>';

        // You can now use the $link variable in your view or return it in a Response
        return $this->render('dashboard/index.html.twig', [
            'link' => $link,
            'linkV' => $linkvoiture,
        ]);
    }

}
