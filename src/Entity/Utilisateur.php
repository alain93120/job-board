<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ApiResource(
    normalizationContext: ['groups' => ['utilisateur:read']],
    denormalizationContext: ['groups' => ['utilisateur:write']]
)]
#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['utilisateur:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['utilisateur:read', 'utilisateur:write'])]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Groups(['utilisateur:write'])]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    #[Groups(['utilisateur:read', 'utilisateur:write'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Groups(['utilisateur:read', 'utilisateur:write'])]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    #[Groups(['utilisateur:read', 'utilisateur:write'])]
    private ?string $role = null;

    /**
     * @var Collection<int, Candidat>
     */
    #[ORM\OneToMany(targetEntity: Candidat::class, mappedBy: 'utilisateur')]
    private Collection $candidats;

    /**
     * @var Collection<int, Compagnie>
     */
    #[ORM\OneToMany(targetEntity: Compagnie::class, mappedBy: 'utilisateur')]
    private Collection $compagnies;

    public function __construct()
    {
        $this->candidats = new ArrayCollection();
        $this->compagnies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return Collection<int, Candidat>
     */
    public function getCandidats(): Collection
    {
        return $this->candidats;
    }

    public function addCandidat(Candidat $candidat): static
    {
        if (!$this->candidats->contains($candidat)) {
            $this->candidats->add($candidat);
            $candidat->setUtilisateur($this);
        }
        return $this;
    }

    public function removeCandidat(Candidat $candidat): static
    {
        if ($this->candidats->removeElement($candidat)) {
            if ($candidat->getUtilisateur() === $this) {
                $candidat->setUtilisateur(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, Compagnie>
     */
    public function getCompagnies(): Collection
    {
        return $this->compagnies;
    }

    public function addCompagnie(Compagnie $compagnie): static
    {
        if (!$this->compagnies->contains($compagnie)) {
            $this->compagnies->add($compagnie);
            $compagnie->setUtilisateur($this);
        }
        return $this;
    }

    public function removeCompagnie(Compagnie $compagnie): static
    {
        if ($this->compagnies->removeElement($compagnie)) {
            if ($compagnie->getUtilisateur() === $this) {
                $compagnie->setUtilisateur(null);
            }
        }
        return $this;
    }

    // --- Implémentation UserInterface / PasswordAuthenticatedUserInterface ---

    public function getRoles(): array
    {
        // Toujours retourner un tableau !
        return [$this->role ?? 'ROLE_USER'];
    }

    public function getUserIdentifier(): string
    {
        return $this->email ?? '';
    }

    public function getUsername(): string
    {
        return $this->getUserIdentifier();
    }

    public function eraseCredentials(): void
    {
        // Si tu stockes un plainPassword temporaire, vide-le ici
        // $this->plainPassword = null;
    }
}
