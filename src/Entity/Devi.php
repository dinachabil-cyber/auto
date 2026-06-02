<?php

namespace App\Entity;

use App\Repository\DeviRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DeviRepository::class)]
#[ORM\Table(name: 'devis')]
class Devi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le nom est obligatoire.')]
    #[Assert\Length(max: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le prénom est obligatoire.')]
    #[Assert\Length(max: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 255)]
    private ?string $raison_sociale = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 255)]
    private ?string $activite = null;

    #[ORM\Column(length: 3, nullable: true)]
    private ?string $demarrage = null;

    #[ORM\Column(length: 3, nullable: true)]
    private ?string $assure = null;

    #[ORM\Column(length: 3, nullable: true)]
    private ?string $ancienne = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Choice(choices: ['Sinistre', 'Non paiement', 'Amiable', 'Échéance'], message: 'Motif invalide.')]
    private ?string $motif_resiliation = null;

    #[ORM\Column(length: 10, nullable: true)]
    #[Assert\Regex('/^[0-9]{5}$/', message: 'Le code postal doit contenir 5 chiffres.')]
    private ?string $code_postal = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Email(message: 'Veuillez saisir un email valide.')]
    private ?string $email = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Assert\Regex('/^0[1-9][0-9]{8}$/', message: 'Le numéro de téléphone est invalide.')]
    private ?string $telephone = null;

    #[ORM\Column(length: 255, options: ['default' => 'nouveau'])]
    private ?string $statut = 'nouveau';

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $created_at = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getRaisonSociale(): ?string
    {
        return $this->raison_sociale;
    }

    public function setRaisonSociale(?string $raison_sociale): static
    {
        $this->raison_sociale = $raison_sociale;

        return $this;
    }

    public function getActivite(): ?string
    {
        return $this->activite;
    }

    public function setActivite(?string $activite): static
    {
        $this->activite = $activite;

        return $this;
    }

    public function getDemarrage(): ?string
    {
        return $this->demarrage;
    }

    public function setDemarrage(?string $demarrage): static
    {
        $this->demarrage = $demarrage;

        return $this;
    }

    public function getAssure(): ?string
    {
        return $this->assure;
    }

    public function setAssure(?string $assure): static
    {
        $this->assure = $assure;

        return $this;
    }

    public function getAncienne(): ?string
    {
        return $this->ancienne;
    }

    public function setAncienne(?string $ancienne): static
    {
        $this->ancienne = $ancienne;

        return $this;
    }

    public function getMotifResiliation(): ?string
    {
        return $this->motif_resiliation;
    }

    public function setMotifResiliation(?string $motif_resiliation): static
    {
        $this->motif_resiliation = $motif_resiliation;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(?string $code_postal): static
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->created_at = new \DateTime();
    }
}