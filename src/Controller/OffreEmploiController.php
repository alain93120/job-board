<?php

namespace App\Controller;

use App\Entity\OffreEmploi;
use App\Repository\OffreEmploiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffreEmploiController extends AbstractController
{
    #[Route('/offre', name: 'offre_list')]
    public function list(OffreEmploiRepository $offreRepo): Response
    {
        $offres = $offreRepo->findAll();

        return $this->render('offre/list.html.twig', [
            'offres' => $offres,
        ]);
    }

    #[Route('/offre/{id}', name: 'offre_detail')]
    public function detail(OffreEmploi $offre): Response
    {
        return $this->render('offre/detail.html.twig', [
            'offre' => $offre,
        ]);
    }
}
