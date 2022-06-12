<?php

namespace App\Entity;

use App\Repository\CarteCadeauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CarteCadeauRepository::class)]
class CarteCadeau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    
    #[ORM\Column(type: 'string', length: 20)]
    /**
     * @Assert\NotBlank
     * @Assert\Length(max=20)
     */
    private $codeCheque;

    #[ORM\Column(type: 'float')]
    /**
     * @Assert\NotBlank
     * @Assert\Length(max=20)
     */
    private $montant;

    #[ORM\Column(type: 'float')]
    /**
     * @Assert\NotBlank
     * @Assert\Length(max=20)
     */
    private $solde;

    #[ORM\Column(type: 'datetime')]
    private $dateC;

    #[ORM\Column(type: 'datetime')]
    private $dateM;

    #[ORM\Column(type: 'datetime')]
    private $DLC;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $divers;

    #[ORM\OneToMany(mappedBy: 'carteCadeau', targetEntity: CarteCadeauOP::class, orphanRemoval: true)]
    private $cartesCadeauOP;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'cartesCadeau')]
    private $user;

    public function __construct()
    {
        $this->cartesCadeauOP = new ArrayCollection();
    }

    //#[ORM\OneToMany(mappedBy: 'idCarteCadeau', targetEntity: CarteCadeauOP::class, orphanRemoval: true)]
    //private $Operations;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeCheque(): ?string
    {
        return $this->codeCheque;
    }

    public function setCodeCheque(string $codeCheque): self
    {
        $this->codeCheque = $codeCheque;

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

    public function getSolde(): ?float
    {
        return $this->solde;
    }

    public function setSolde(float $solde): self
    {
        $this->solde = $solde;

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

    public function getDLC(): ?\DateTimeInterface
    {
        return $this->DLC;
    }

    public function setDLC(\DateTimeInterface $DLC): self
    {
        $this->DLC = $DLC;

        return $this;
    }

    public function getDivers(): ?string
    {
        return $this->divers;
    }

    public function setDivers(?string $divers): self
    {
        $this->divers = $divers;

        return $this;
    }

    /**
     * @return Collection<int, CarteCadeauOP>
     */
    public function getCartesCadeauOP(): Collection
    {
        return $this->cartesCadeauOP;
    }

    public function addCartesCadeauOP(CarteCadeauOP $cartesCadeauOP): self
    {
        if (!$this->cartesCadeauOP->contains($cartesCadeauOP)) {
            $this->cartesCadeauOP[] = $cartesCadeauOP;
            $cartesCadeauOP->setCarteCadeau($this);
        }

        return $this;
    }

    public function removeCartesCadeauOP(CarteCadeauOP $cartesCadeauOP): self
    {
        if ($this->cartesCadeauOP->removeElement($cartesCadeauOP)) {
            // set the owning side to null (unless already changed)
            if ($cartesCadeauOP->getCarteCadeau() === $this) {
                $cartesCadeauOP->setCarteCadeau(null);
            }
        }

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
