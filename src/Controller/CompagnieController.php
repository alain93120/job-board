<?php

namespace App\Controller;

use App\Repository\CompagnieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompagnieController extends AbstractController
{
    #[Route('/compagnies', name: 'compagnie_list')]
    public function list(CompagnieRepository $compagnieRepo): Response
    {
        $compagnies = $compagnieRepo->findAll();

        return $this->render('compagnie/list.html.twig', [
            'compagnies' => $compagnies,
        ]);
    }
}