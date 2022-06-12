<?php

namespace App\Entity;

use App\Repository\TestProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestProduitRepository::class)]
class TestProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'testProduits', targetEntity: TestProduitPromo::class)]
    private $testProduitPromos;

    public function __construct()
    {
        $this->testProduitPromos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, TestProduitPromo>
     */
    public function getTestProduitPromos(): Collection
    {
        return $this->testProduitPromos;
    }

    public function addTestProduitPromo(TestProduitPromo $testProduitPromo): self
    {
        if (!$this->testProduitPromos->contains($testProduitPromo)) {
            $this->testProduitPromos[] = $testProduitPromo;
            $testProduitPromo->setTestProduits($this);
        }

        return $this;
    }

    public function removeTestProduitPromo(TestProduitPromo $testProduitPromo): self
    {
        if ($this->testProduitPromos->removeElement($testProduitPromo)) {
            // set the owning side to null (unless already changed)
            if ($testProduitPromo->getTestProduits() === $this) {
                $testProduitPromo->setTestProduits(null);
            }
        }

        return $this;
    }
}
