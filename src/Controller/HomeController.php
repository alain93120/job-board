<?php

namespace App\Controller;

use App\Repository\OffreEmploiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request, OffreEmploiRepository $offreRepo): Response
    {
        // Récupérer le filtre secteur
        $secteurFiltre = $request->query->get('secteur');

        // Requête pour offres, avec filtre secteur via la compagnie
        $qb = $offreRepo->createQueryBuilder('o')
            ->leftJoin('o.compagnie', 'c');

        if ($secteurFiltre) {
            $qb->andWhere('c.secteur = :secteur')
               ->setParameter('secteur', $secteurFiltre);
        }

        $offres = $qb
            ->orderBy('o.date_publication', 'DESC')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult();

        // Récupère tous les secteurs distincts (via la compagnie)
        $secteurs = $offreRepo->createQueryBuilder('o')
            ->select('DISTINCT c.secteur')
            ->join('o.compagnie', 'c')
            ->where('c.secteur IS NOT NULL')
            ->getQuery()->getResult();

        return $this->render('home/index.html.twig', [
            'offres' => $offres,
            'secteurs' => array_column($secteurs, 'secteur'),
            'secteurFiltre' => $secteurFiltre,
        ]);
    }
}

