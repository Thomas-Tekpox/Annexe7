<?php

namespace App\Entity;

use App\Repository\GalerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GalerieRepository::class)]
class Galerie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $lbl;

    #[ORM\Column(type: 'integer')]
    private $dimensionX;

    #[ORM\Column(type: 'integer')]
    private $dimensionY;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'datetime')]
    private $date_c;

    #[ORM\Column(type: 'datetime')]
    private $date_m;

    #[ORM\Column(type: 'boolean')]
    private $actif;

    #[ORM\OneToMany(mappedBy: 'Galerie_id', targetEntity: GaleriePhotos::class, orphanRemoval: true)]
    private $galeriePhotos;

    public function __construct()
    {
        $this->galeriePhotos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLbl(): ?string
    {
        return $this->lbl;
    }

    public function setLbl(string $lbl): self
    {
        $this->lbl = $lbl;

        return $this;
    }

    public function getDimensionX(): ?int
    {
        return $this->dimensionX;
    }

    public function setDimensionX(int $dimensionX): self
    {
        $this->dimensionX = $dimensionX;

        return $this;
    }

    public function getDimensionY(): ?int
    {
        return $this->dimensionY;
    }

    public function setDimensionY(int $dimensionY): self
    {
        $this->dimensionY = $dimensionY;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * @return Collection<int, GaleriePhotos>
     */
    public function getGaleriePhotos(): Collection
    {
        return $this->galeriePhotos;
    }

    public function addGaleriePhoto(GaleriePhotos $galeriePhoto): self
    {
        if (!$this->galeriePhotos->contains($galeriePhoto)) {
            $this->galeriePhotos[] = $galeriePhoto;
            $galeriePhoto->setGalerieId($this);
        }

        return $this;
    }

    public function removeGaleriePhoto(GaleriePhotos $galeriePhoto): self
    {
        if ($this->galeriePhotos->removeElement($galeriePhoto)) {
            // set the owning side to null (unless already changed)
            if ($galeriePhoto->getGalerieId() === $this) {
                $galeriePhoto->setGalerieId(null);
            }
        }

        return $this;
    }
}
