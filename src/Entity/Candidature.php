<?php

namespace App\Entity;

use App\Repository\CandidatureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidatureRepository::class)]
class Candidature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_candidature = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $statut = null;

    #[ORM\ManyToOne(inversedBy: 'candidatures')]
    private ?candidat $candidat = null;

    #[ORM\ManyToOne(inversedBy: 'candidatures')]
    private ?offreEmploi $offreEmploi = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCandidature(): ?\DateTime
    {
        return $this->date_candidature;
    }

    public function setDateCandidature(\DateTime $date_candidature): static
    {
        $this->date_candidature = $date_candidature;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getCandidat(): ?candidat
    {
        return $this->candidat;
    }

    public function setCandidat(?candidat $candidat): static
    {
        $this->candidat = $candidat;

        return $this;
    }

    public function getOffreEmploi(): ?offreEmploi
    {
        return $this->offreEmploi;
    }

    public function setOffreEmploi(?offreEmploi $offreEmploi): static
    {
        $this->offreEmploi = $offreEmploi;

        return $this;
    }
}
