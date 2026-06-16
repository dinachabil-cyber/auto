<?php

namespace App\Entity;

use App\Repository\ProfessionelRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: ProfessionelRepository::class)]
#[ORM\Table(name: 'professionel')]
class Professionel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le nom est obligatoire.')]
    #[Assert\Length(max: 255)]
    #[Assert\NoSpam(messageKeyword: 'Le nom contient des mots ou contenus interdits.')]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le prénom est obligatoire.')]
    #[Assert\Length(max: 255)]
    #[Assert\NoSpam(messageKeyword: 'Le prénom contient des mots ou contenus interdits.')]
    private ?string $prenom = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $product = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $demarrage = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: 'La raison sociale est obligatoire.')]
    #[Assert\NoSpam(messageKeyword: 'La raison sociale contient des mots ou contenus interdits.')]
    private ?string $raison_sociale = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: 'L activité est obligatoire.')]
    #[Assert\NoSpam(messageKeyword: 'L activité contient des mots ou contenus interdits.')]
    private ?string $activite = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: 'L activité assurée est obligatoire.')]
    private ?string $assure = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code_postal = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: 'L ancienne assurance est obligatoire.')]
    private ?string $ancienne = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $motif = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'L email est obligatoire.')]
    #[Assert\Email(message: 'Veuillez saisir un email valide.')]
    #[Assert\NoSpam(messageUrl: 'Les emails ne doivent pas contenir de lien.', messageKeyword: 'L email contient des mots interdits.')]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le téléphone est obligatoire.')]
    #[Assert\Regex('/^0[1-9]([0-9]{2} ?){4}$/', message: 'Le numéro de téléphone est invalide.')]
    private ?string $tele = null;

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

    public function getProduct(): ?string
    {
        return $this->product;
    }

    public function setProduct(?string $product): static
    {
        $this->product = $product;
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

    public function getAssure(): ?string
    {
        return $this->assure;
    }

    public function setAssure(?string $assure): static
    {
        $this->assure = $assure;
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

    public function getAncienne(): ?string
    {
        return $this->ancienne;
    }

    public function setAncienne(?string $ancienne): static
    {
        $this->ancienne = $ancienne;
        return $this;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(?string $motif): static
    {
        $this->motif = $motif;
        return $this;
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

    public function getTele(): ?string
    {
        return $this->tele;
    }

    public function setTele(string $tele): static
    {
        $this->tele = $tele;
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

    #[Assert\Callback]
    public function validateMotif(ExecutionContextInterface $context): void
    {
        if ($this->ancienne === 'OUI' && (null === $this->motif || '' === $this->motif)) {
            $context->buildViolation('Le motif est obligatoire quand l ancienne assurance est résiliée.')
                ->atPath('motif')
                ->addViolation();
        }
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->created_at = new \DateTime();
    }
}