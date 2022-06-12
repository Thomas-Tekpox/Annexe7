<?php

namespace App\Entity;

use App\Repository\ProduitCodePromoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitCodePromoRepository::class)]
class ProduitCodePromo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: 'produitsCodePromo')]
    #[ORM\JoinColumn(nullable: false)]
    private $produit;

    #[ORM\ManyToOne(targetEntity: CodePromo::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $codePromo;

    #[ORM\Column(type: 'integer')]
    private $quantite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getCodePromo(): ?CodePromo
    {
        return $this->codePromo;
    }

    public function setCodePromo(?CodePromo $codePromo): self
    {
        $this->codePromo = $codePromo;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }
}
