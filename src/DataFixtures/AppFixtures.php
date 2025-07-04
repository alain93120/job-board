<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use App\Entity\Compagnie;
use App\Entity\Candidat;
use App\Entity\OffreEmploi;
use App\Entity\Candidature;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création d’un utilisateur “compagnie”
        $userCompagnie = new Utilisateur();
        $userCompagnie->setEmail('rh@entreprise.com');
        $userCompagnie->setPassword('password'); // Normalement, hash à faire
        $userCompagnie->setNom('Entreprise');
        $userCompagnie->setPrenom('RH');
        $userCompagnie->setRole('ROLE_COMPAGNIE');
        $manager->persist($userCompagnie);

        // Création d’une compagnie
        $compagnie = new Compagnie();
        $compagnie->setNomCompagnie('OpenAI');
        $compagnie->setSecteur('IA');
        $compagnie->setDescription('Intelligence Artificielle');
        $compagnie->setUtilisateur($userCompagnie);
        $manager->persist($compagnie);

        // Création d’un utilisateur “candidat”
        $userCandidat = new Utilisateur();
        $userCandidat->setEmail('user@job.com');
        $userCandidat->setPassword('password');
        $userCandidat->setNom('Doe');
        $userCandidat->setPrenom('John');
        $userCandidat->setRole('ROLE_CANDIDAT');
        $manager->persist($userCandidat);

        // Création d’un candidat
        $candidat = new Candidat();
        $candidat->setTelephone('0612345678');
        $candidat->setCv('cv_johndoe.pdf');
        $candidat->setUtilisateur($userCandidat);
        $manager->persist($candidat);

        // Création d’une offre d’emploi
        $offre = new OffreEmploi();
        $offre->setTitre('Développeur Symfony');
        $offre->setDescription('Développer des applications Symfony.');     
        $offre->setTypeDeContrat('CDI');
        $offre->setSalaire('3500€');
        $offre->setDatePublication(new \DateTime());
        $offre->setStatut('ouverte');
        $offre->setCompagnie($compagnie);
        $manager->persist($offre);

        // Création d’une candidature
        $candidature = new Candidature();
        $candidature->setDateCandidature(new \DateTime());
        $candidature->setMessage('Je suis motivé !');
        $candidature->setStatut('en_attente');
        $candidature->setCandidat($candidat);
        $candidature->setOffreEmploi($offre);
        $manager->persist($candidature);

        // Sauvegarde en base
        $manager->flush();
    }
}
