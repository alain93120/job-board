<?php

namespace App\Controller;

use App\Repository\OffreEmploiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(OffreEmploiRepository $offreRepo): Response
    {
        // On récupère les dernières offres
        $offres = $offreRepo->findBy([], ['datePublication' => 'DESC'], 6);

        return $this->render('home/index.html.twig', [
            'offres' => $offres,
        ]);
    }
}
