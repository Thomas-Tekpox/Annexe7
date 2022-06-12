<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Lbl;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $photoH;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $photoV;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $descriptif;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $LblPanier;

    #[ORM\Column(type: 'float')]
    private $prixAchat;

    #[ORM\Column(type: 'float')]
    private $prix;

    #[ORM\Column(type: 'float')]
    private $primePersonnalisationPhotographe;

    #[ORM\Column(type: 'float')]
    private $primePersonnalisationMUA;

    #[ORM\Column(type: 'boolean')]
    private $visibleClient;

    #[ORM\Column(type: 'boolean')]
    private $actif;

    #[ORM\Column(type: 'datetime')] // à supprimer
    private $DLC;

    #[ORM\Column(type: 'datetime')]
    private $dateC;

    #[ORM\Column(type: 'datetime')]
    private $dateM;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: ProduitCodePromo::class, orphanRemoval: true)]
    private $produitsCodePromo;

    #[ORM\Column(type: 'integer')]
    private $ordreEligiblePromo;

    #[ORM\ManyToOne(targetEntity: CategorieProduit::class, inversedBy: 'produits')]
    private $categorieProduit;

    public function __construct()
    {
        $this->codeProduit = new ArrayCollection();
        $this->produitsCodePromo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLbl(): ?string
    {
        return $this->Lbl;
    }

    public function setLbl(string $Lbl): self
    {
        $this->Lbl = $Lbl;

        return $this;
    }

    public function getPhotoH(): ?string
    {
        return $this->photoH;
    }

    public function setPhotoH(?string $photoH): self
    {
        $this->photoH = $photoH;

        return $this;
    }

    public function getPhotoV(): ?string
    {
        return $this->photoV;
    }

    public function setPhotoV(?string $photoV): self
    {
        $this->photoV = $photoV;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(?string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getLblPanier(): ?string
    {
        return $this->LblPanier;
    }

    public function setLblPanier(?string $LblPanier): self
    {
        $this->LblPanier = $LblPanier;

        return $this;
    }

    public function getPrixAchat(): ?float
    {
        return $this->prixAchat;
    }

    public function setPrixAchat(float $prixAchat): self
    {
        $this->prixAchat = $prixAchat;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getPrimePersonnalisationPhotographe(): ?float
    {
        return $this->primePersonnalisationPhotographe;
    }

    public function setPrimePersonnalisationPhotographe(float $primePersonnalisationPhotographe): self
    {
        $this->primePersonnalisationPhotographe = $primePersonnalisationPhotographe;

        return $this;
    }

    public function getPrimePersonnalisationMUA(): ?float
    {
        return $this->primePersonnalisationMUA;
    }

    public function setPrimePersonnalisationMUA(float $primePersonnalisationMUA): self
    {
        $this->primePersonnalisationMUA = $primePersonnalisationMUA;

        return $this;
    }

    public function getVisibleClient(): ?bool
    {
        return $this->visibleClient;
    }

    public function setVisibleClient(bool $visibleClient): self
    {
        $this->visibleClient = $visibleClient;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

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

    public function getDateM(): ?\DateTimeInterface
    {
        return $this->dateM;
    }

    public function setDateM(\DateTimeInterface $dateM): self
    {
        $this->dateM = $dateM;

        return $this;
    }

    /**
     * @return Collection<int, ProduitCodePromo>
     */
    public function getProduitsCodePromo(): Collection
    {
        return $this->produitsCodePromo;
    }

    public function addProduitsCodePromo(ProduitCodePromo $produitsCodePromo): self
    {
        if (!$this->produitsCodePromo->contains($produitsCodePromo)) {
            $this->produitsCodePromo[] = $produitsCodePromo;
            $produitsCodePromo->setProduit($this);
        }

        return $this;
    }

    public function removeProduitsCodePromo(ProduitCodePromo $produitsCodePromo): self
    {
        if ($this->produitsCodePromo->removeElement($produitsCodePromo)) {
            // set the owning side to null (unless already changed)
            if ($produitsCodePromo->getProduit() === $this) {
                $produitsCodePromo->setProduit(null);
            }
        }

        return $this;
    }

    public function getOrdreEligiblePromo(): ?int
    {
        return $this->ordreEligiblePromo;
    }

    public function setOrdreEligiblePromo(int $ordreEligiblePromo): self
    {
        $this->ordreEligiblePromo = $ordreEligiblePromo;

        return $this;
    }

    public function getCategorieProduit(): ?CategorieProduit
    {
        return $this->categorieProduit;
    }

    public function setCategorieProduit(?CategorieProduit $categorieProduit): self
    {
        $this->categorieProduit = $categorieProduit;

        return $this;
    }
}
