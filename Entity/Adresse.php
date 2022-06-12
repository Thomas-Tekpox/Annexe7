<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdresseRepository::class)]
class Adresse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $nom;

    #[ORM\Column(type: 'string', length: 50)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $societe;

    #[ORM\Column(type: 'string', length: 200)]
    private $rue;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    private $rue2;

    #[ORM\Column(type: 'string', length: 10)]
    private $CP;

    #[ORM\Column(type: 'string', length: 100)]
    private $ville;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $pays;

    #[ORM\Column(type: 'string', length: 1)]
    private $typeAdresse;

    #[ORM\Column(type: 'string', length: 30)]
    private $Lbl;

    #[ORM\Column(type: 'string', length: 1, nullable: true)]
    private $dernierUsage;

    #[ORM\Column(type: 'datetime')]
    private $dateC;

    #[ORM\Column(type: 'datetime')]
    private $dateM;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'adresses')]
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getSociete(): ?string
    {
        return $this->societe;
    }

    public function setSociete(?string $societe): self
    {
        $this->societe = $societe;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(?string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getRue2(): ?string
    {
        return $this->rue2;
    }

    public function setRue2(?string $rue2): self
    {
        $this->rue2 = $rue2;

        return $this;
    }

    public function getCP(): ?string
    {
        return $this->CP;
    }

    public function setCP(?string $CP): self
    {
        $this->CP = $CP;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getTypeAdresse(): ?string
    {
        return $this->typeAdresse;
    }

    public function setTypeAdresse(?string $typeAdresse): self
    {
        $this->typeAdresse = $typeAdresse;

        return $this;
    }

    public function getLbl(): ?string
    {
        return $this->Lbl;
    }

    public function setLbl(?string $Lbl): self
    {
        $this->Lbl = $Lbl;

        return $this;
    }

    public function getDernierUsage(): ?string
    {
        return $this->dernierUsage;
    }

    public function setDernierUsage(?string $dernierUsage): self
    {
        $this->dernierUsage = $dernierUsage;

        return $this;
    }

    public function getDateC(): ?\DateTimeInterface
    {
        return $this->dateC;
    }

    public function setDateC(\DateTimeInterface $dateC): self
    {
        $this->dateC = $dateC;

        return $this;
    }

    public function getDateM(): ?\DateTimeInterface
    {
        return $this->dateM;
    }

    public function setDateM(\DateTimeInterface $dateM): self
    {
        $this->dateM = $dateM;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
