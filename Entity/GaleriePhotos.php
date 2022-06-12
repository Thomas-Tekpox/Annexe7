<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use App\Repository\GaleriePhotosRepository;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @Vich\Uploadable
 */
#[ORM\Entity(repositoryClass: GaleriePhotosRepository::class)]
class GaleriePhotos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Galerie::class, inversedBy: 'galeriePhotos')]
    #[ORM\JoinColumn(nullable: false)]
    private $galerie_id;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="galerie_image", fileNameProperty="imageName", size="imageSize")
     */
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string')]
    private ?string $imageName = null;

    #[ORM\Column(type: 'integer')]
    private ?int $imageSize = null;

    #[ORM\Column(type: 'string', length: 255)]
    private $alt;

    #[ORM\Column(type: 'integer')]
    private $dimensionX;

    #[ORM\Column(type: 'integer')]
    private $dimensionY;

    #[ORM\Column(type: 'integer')]
    private $visibilite;

    #[ORM\Column(type: 'boolean')]
    private $actif;

    #[ORM\Column(type: 'integer')]
    private $ordre;

    #[ORM\Column(type: 'datetime')]
    private $filedate;
   
    // #[ORM\Column(type: 'string', length: 255)]
    // private $url;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGalerieId(): ?Galerie
    {
        return $this->galerie_id;
    }

    public function setGalerieId(?Galerie $galerie_id): self
    {
        $this->galerie_id = $galerie_id;

        return $this;
    }

   /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }
    
    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(string $alt): self
    {
        $this->alt = $alt;

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

    public function getVisibilite(): ?int
    {
        return $this->visibilite;
    }

    public function setVisibilite(int $visibilite): self
    {
        $this->visibilite = $visibilite;

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

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function getFiledate(): ?\DateTimeInterface
    {
        return $this->filedate;
    }

    public function setFiledate(\DateTimeInterface $filedate): self
    {
        $this->filedate = $filedate;

        return $this;
    }

    // public function getUrl(): ?string
    // {
    //     return $this->url;
    // }

    // public function setUrl(string $url): Self
    // {
    //     $this->url = $url;

    //     return $this;
    // }
}
