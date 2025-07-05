<?php

namespace App\Controller;

use App\Entity\OffreEmploi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffreEmploiController extends AbstractController
{
    #[Route('/offre/{id}', name: 'offre_detail')]
    public function detail(OffreEmploi $offre): Response
    {
        return $this->render('offre/detail.html.twig', [
            'offre' => $offre,
        ]);
    }
}
