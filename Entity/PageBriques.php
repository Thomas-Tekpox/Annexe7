<?php

namespace App\Entity;

use App\Repository\PageBriquesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PageBriquesRepository::class)]
class PageBriques
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Page::class, inversedBy: 'pageBriques')]
    #[ORM\JoinColumn(nullable: false)]
    private $page;

    #[ORM\ManyToOne(targetEntity: Brique::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $brique;

    #[ORM\Column(type: 'integer')]
    private $ordreBrique;

    #[ORM\Column(type: 'array')]
    private $parametres = [];

    #[ORM\Column(type: 'boolean')]
    private $actif;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPage(): ?Page
    {
        return $this->page;
    }

    public function setPage(?Page $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getBrique(): ?Brique
    {
        return $this->brique;
    }

    public function setBrique(?Brique $brique): self
    {
        $this->brique = $brique;

        return $this;
    }

    public function getOrdreBrique(): ?int
    {
        return $this->ordreBrique;
    }

    public function setOrdreBrique(int $ordreBrique): self
    {
        $this->ordreBrique = $ordreBrique;

        return $this;
    }

    public function getParametres(): ?array
    {
        return $this->parametres;
    }

    public function setParametres(array $parametres): self
    {
        $this->parametres = $parametres;

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
}
