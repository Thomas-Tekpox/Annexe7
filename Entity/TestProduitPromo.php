<?php

namespace App\Entity;

use App\Repository\TestProduitPromoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestProduitPromoRepository::class)]
class TestProduitPromo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: TestProduit::class, inversedBy: 'testProduitPromos')]
    #[ORM\JoinColumn(nullable: false)]
    private $testProduits;

    #[ORM\ManyToOne(targetEntity: TestPromo::class, inversedBy: 'testProduitPromos')]
    #[ORM\JoinColumn(nullable: false)]
    private $testPromo;

    #[ORM\Column(type: 'integer')]
    private $quantite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTestProduits(): ?TestProduit
    {
        return $this->testProduits;
    }

    public function setTestProduits(?TestProduit $testProduits): self
    {
        $this->testProduits = $testProduits;

        return $this;
    }

    public function getTestPromo(): ?TestPromo
    {
        return $this->testPromo;
    }

    public function setTestPromo(?TestPromo $testPromo): self
    {
        $this->testPromo = $testPromo;

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
