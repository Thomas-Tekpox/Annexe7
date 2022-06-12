<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestRepository::class)]
class Test
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $idShootingPhoto;

    #[ORM\Column(type: 'integer')]
    private $idShootingGalerie;

    #[ORM\Column(type: 'string', length: 50)]
    private $nomReel;

    #[ORM\Column(type: 'integer')]
    private $idPhoto;

    #[ORM\Column(type: 'string', length: 10)]
    private $salt;

    #[ORM\Column(type: 'integer')]
    private $groupe;

    #[ORM\Column(type: 'integer')]
    private $actif;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdShootingPhoto(): ?int
    {
        return $this->idShootingPhoto;
    }

    public function setIdShootingPhoto(int $idShootingPhoto): self
    {
        $this->idShootingPhoto = $idShootingPhoto;

        return $this;
    }

    public function getIdShootingGalerie(): ?int
    {
        return $this->idShootingGalerie;
    }

    public function setIdShootingGalerie(int $idShootingGalerie): self
    {
        $this->idShootingGalerie = $idShootingGalerie;

        return $this;
    }

    public function getNomReel(): ?string
    {
        return $this->nomReel;
    }

    public function setNomReel(string $nomReel): self
    {
        $this->nomReel = $nomReel;

        return $this;
    }

    public function getIdPhoto(): ?int
    {
        return $this->idPhoto;
    }

    public function setIdPhoto(int $idPhoto): self
    {
        $this->idPhoto = $idPhoto;

        return $this;
    }

    public function getSalt(): ?string
    {
        return $this->salt;
    }

    public function setSalt(string $salt): self
    {
        $this->salt = $salt;

        return $this;
    }

    public function getGroupe(): ?int
    {
        return $this->groupe;
    }

    public function setGroupe(int $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }

    public function getActif(): ?int
    {
        return $this->actif;
    }

    public function setActif(int $actif): self
    {
        $this->actif = $actif;

        return $this;
    }
}
