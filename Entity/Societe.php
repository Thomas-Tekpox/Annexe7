<?php

namespace App\Entity;

use App\Repository\SocieteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SocieteRepository::class)]
class Societe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $Rue1;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Rue2;

    #[ORM\Column(type: 'string', length: 20)]
    private $CP;

    #[ORM\Column(type: 'string', length: 255)]
    private $Ville;

    #[ORM\Column(type: 'datetime')]
    private $date_c;

    #[ORM\Column(type: 'datetime')]
    private $date_m;

    #[ORM\OneToOne(inversedBy: 'societe', targetEntity: user::class, cascade: ['persist', 'remove'])]
    private $IdContact;

    #[ORM\Column(type: 'boolean')]
    private $actif;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getRue1(): ?string
    {
        return $this->Rue1;
    }

    public function setRue1(string $Rue1): self
    {
        $this->Rue1 = $Rue1;

        return $this;
    }

    public function getRue2(): ?string
    {
        return $this->Rue2;
    }

    public function setRue2(?string $Rue2): self
    {
        $this->Rue2 = $Rue2;

        return $this;
    }

    public function getCP(): ?string
    {
        return $this->CP;
    }

    public function setCP(string $CP): self
    {
        $this->CP = $CP;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(string $Ville): self
    {
        $this->Ville = $Ville;

        return $this;
    }

    public function getDateC(): ?\DateTimeInterface
    {
        return $this->date_c;
    }

    public function setDateC(\DateTimeInterface $date_c): self
    {
        $this->date_c = $date_c;

        return $this;
    }

    public function getDateM(): ?\DateTimeInterface
    {
        return $this->date_m;
    }

    public function setDateM(\DateTimeInterface $date_m): self
    {
        $this->date_m = $date_m;

        return $this;
    }

    public function getIdContact(): ?user
    {
        return $this->IdContact;
    }

    public function setIdContact(?user $IdContact): self
    {
        $this->IdContact = $IdContact;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }
}
