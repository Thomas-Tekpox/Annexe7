<?php

namespace App\Entity;

use App\Repository\CarteCadeauOPRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarteCadeauOPRepository::class)]
class CarteCadeauOP
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $dateC;

    #[ORM\Column(type: 'string', length: 1)]
    private $typeOperation;

    #[ORM\Column(type: 'float')]
    private $montant;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Lbl;

    #[ORM\ManyToOne(targetEntity: CarteCadeau::class, inversedBy: 'cartesCadeauOP')]
    #[ORM\JoinColumn(nullable: false)]
    private $carteCadeau;

    public function __construct()
    {
        $this->idUser = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTypeOperation(): ?string
    {
        return $this->typeOperation;
    }

    public function setOperation(string $typeOperation): self
    {
        $this->typeOperation = $typeOperation;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

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

    public function getCarteCadeau(): ?CarteCadeau
    {
        return $this->carteCadeau;
    }

    public function setCarteCadeau(?CarteCadeau $carteCadeau): self
    {
        $this->carteCadeau = $carteCadeau;

        return $this;
    }
}
