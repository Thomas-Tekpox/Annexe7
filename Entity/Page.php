<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PageRepository::class)]
class Page
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $url;

    #[ORM\Column(type: 'boolean')]
    private $active;

    #[ORM\OneToMany(mappedBy: 'page', targetEntity: PageBriques::class, orphanRemoval: true)]
    private $pageBriques;

    public function __construct()
    {
        $this->pageBriques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection<int, PageBriques>
     */
    public function getPageBriques(): Collection
    {
        return $this->pageBriques;
    }

    public function addPageBrique(PageBriques $pageBrique): self
    {
        if (!$this->pageBriques->contains($pageBrique)) {
            $this->pageBriques[] = $pageBrique;
            $pageBrique->setPage($this);
        }

        return $this;
    }

    public function removePageBrique(PageBriques $pageBrique): self
    {
        if ($this->pageBriques->removeElement($pageBrique)) {
            // set the owning side to null (unless already changed)
            if ($pageBrique->getPage() === $this) {
                $pageBrique->setPage(null);
            }
        }

        return $this;
    }
}
