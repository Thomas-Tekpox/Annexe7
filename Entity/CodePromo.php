<?php

namespace App\Entity;

use App\Repository\CodePromoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CodePromoRepository::class)]
class CodePromo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 20)]
    private $code;

    #[ORM\Column(type: 'datetime')]
    private $DLC;

    #[ORM\Column(type: 'datetime')]
    private $dateC;

    #[ORM\Column(type: 'float')]
    private $montant;

    #[ORM\Column(type: 'string', length: 1)]
    private $typePromo;

    #[ORM\Column(type: 'float')]
    private $montantMinimum;

    #[ORM\OneToMany(mappedBy: 'codePromo', targetEntity: ProduitCodePromo::class)]
    private $produits;

    #[ORM\Column(type: 'boolean')]
    private $fraisDePortOfferts;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDLC(): ?\DateTimeInterface
    {
        return $this->DLC;
    }

    public function setDLC(\DateTimeInterface $DLC): self
    {
        $this->DLC = $DLC;

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

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getTypePromo(): ?string
    {
        return $this->typePromo;
    }

    public function setTypePromo(string $typePromo): self
    {
        $this->typePromo = $typePromo;

        return $this;
    }

    public function getMontantMinimum(): ?float
    {
        return $this->montantMinimum;
    }

    public function setMontantMinimum(float $montantMinimum): self
    {
        $this->montantMinimum = $montantMinimum;

        return $this;
    }

    /**
     * @return Collection<int, ProduitCodePromo>
     */
    public function getProduit(): Collection
    {
        return $this->produits;
    }

    public function addProduit(ProduitCodePromo $produits): self
    {
        if (!$this->produits->contains($produits)) {
            $this->produits[] = $produits;
            $produits->setCodePromo($this);
        }

        return $this;
    }

    public function removeProduit(ProduitCodePromo $produits): self
    {
        if ($this->produits->removeElement($produits)) {
            // set the owning side to null (unless already changed)
            if ($produits->getCodePromo() === $this) {
                $produits->setCodePromo(null);
            }
        }

        return $this;
    }

    public function getFraisDePortOfferts(): ?bool
    {
        return $this->fraisDePortOfferts;
    }

    public function setFraisDePortOfferts(bool $fraisDePortOfferts): self
    {
        $this->fraisDePortOfferts = $fraisDePortOfferts;

        return $this;
    }
}
