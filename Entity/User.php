<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 50)]
    private $nom;

    #[ORM\Column(type: 'string', length: 50)]
    private $prenom;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: CarteCadeau::class)]
    private $cartesCadeau;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Adresse::class)]
    private $adresses;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\Column(type: 'string', length: 1, nullable: true)]
    private $sexe;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $mobile;

    #[ORM\Column(type: 'date', nullable: true)]
    private $date_naissance;

    #[ORM\OneToOne(mappedBy: 'IdContact', targetEntity: Societe::class, cascade: ['persist', 'remove'])]
    private $societe;

    public function __construct()
    {
        $this->cartesCadeau = new ArrayCollection();
        $this->adresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
        // return $this->email[0] .  mb_substr($this->email, 2);
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        // $this->email = $email[0] . mb_substr('abcdefghijklmnopqrstuvwxyz', rand(0, 25), 1) .  mb_substr($this->email, 1);
        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, CarteCadeau>
     */
    public function getCartesCadeau(): Collection
    {
        return $this->cartesCadeau;
    }

    public function addCartesCadeau(CarteCadeau $cartesCadeau): self
    {
        if (!$this->cartesCadeau->contains($cartesCadeau)) {
            $this->cartesCadeau[] = $cartesCadeau;
            $cartesCadeau->setUser($this);
        }

        return $this;
    }

    public function removeCartesCadeau(CarteCadeau $cartesCadeau): self
    {
        if ($this->cartesCadeau->removeElement($cartesCadeau)) {
            // set the owning side to null (unless already changed)
            if ($cartesCadeau->getUser() === $this) {
                $cartesCadeau->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Adresse>
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses[] = $adress;
            $adress->setUser($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->removeElement($adress)) {
            // set the owning side to null (unless already changed)
            if ($adress->getUser() === $this) {
                $adress->setUser(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(?string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(?\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getSociete(): ?Societe
    {
        return $this->societe;
    }

    public function setSociete(?Societe $societe): self
    {
        // unset the owning side of the relation if necessary
        if ($societe === null && $this->societe !== null) {
            $this->societe->setIdContact(null);
        }

        // set the owning side of the relation if necessary
        if ($societe !== null && $societe->getIdContact() !== $this) {
            $societe->setIdContact($this);
        }

        $this->societe = $societe;

        return $this;
    }
}
