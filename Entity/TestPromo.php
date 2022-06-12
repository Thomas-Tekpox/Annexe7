<?php

namespace App\Entity;

use App\Repository\TestPromoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestPromoRepository::class)]
class TestPromo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $code;

    #[ORM\OneToMany(mappedBy: 'testPromo', targetEntity: TestProduitPromo::class)]
    private $testProduitPromos;

    public function __construct()
    {
        $this->testProduitPromos = new ArrayCollection();
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
            $testProduitPromo->setTestPromo($this);
        }

        return $this;
    }

    public function removeTestProduitPromo(TestProduitPromo $testProduitPromo): self
    {
        if ($this->testProduitPromos->removeElement($testProduitPromo)) {
            // set the owning side to null (unless already changed)
            if ($testProduitPromo->getTestPromo() === $this) {
                $testProduitPromo->setTestPromo(null);
            }
        }

        return $this;
    }
}
