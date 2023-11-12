<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VoitureRepository;
use App\Form\SearchFormType;
use App\Data\SearchData;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Twig\Environment;
use App\Entity\Voiture;

class VoitureController extends AbstractController
{
    #[Route('/', name: 'voiture')]
    public function index(VoitureRepository $repository, Request $request): Response
    {
        $data = new SearchData();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(SearchFormType::class, $data);
        $form->handleRequest($request);
        [$min, $max] = $repository->findMinMax($data);
        $voitures = $repository->findSearch($data);
        if ($request->get('ajax')){
            sleep(1);
            return new JsonResponse([
                'content' => $this->renderView('voiture/_voitures.html.twig', ['voitures' => $voitures]),
                'sorting' => $this->renderView('voiture/_sorting.html.twig', ['voitures' => $voitures]),
                'pagination' => $this->renderView('voiture/_pagination.html.twig', ['voitures' => $voitures]),
                'pages' => ceil($voitures->getTotalItemCount() / $voitures->getItemNumberPerPage()),
                'min' => $min,
                'max' => $max
            ]);
        }

        return $this->render('voiture/index.html.twig', [
            'voitures' => $voitures,
            'form' => $form->createView(),
            'min' => $min,
            'max' => $max
        
        ]);
    }

    #[Route('/voiture/{id}', name: 'details')]
    public function detailsVoiture(Environment $twig, Voiture $voiture, VoitureRepository $voitureRepository): Response
    {
        return new Response($twig->render('voiture{id}/index.html.twig', [
            'voiture' => $voiture,
            'voitures' => $voitureRepository->findAll()
        ]));
    }
}
