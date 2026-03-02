<?php

namespace App\Entity;

use App\Repository\EmployeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: EmployeRepository::class)]
#[ORM\Table(name: 'employe')]
class Employe implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'idEmploye')]
    private ?int $id = null;

    #[ORM\Column(length: 250)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(
    type: Types::STRING, 
    length: 20,
    columnDefinition: "ENUM('admin', 'gestionnaire')",
    options: ['default' => 'gestionnaire']
    )]
    private ?string $role = 'gestionnaire';

    #[ORM\Column(length: 50)]
    private ?string $login = null;

    #[ORM\Column(length: 255)]
    private ?string $mdp = null;

    #[ORM\Column(type: Types::BOOLEAN, options: ['default' => 1])]
    private ?bool $actif = true;

    #[ORM\Column(type: Types::BOOLEAN, options: ['default' => 0])]
    private ?bool $supprime = false;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $dateCreation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $dateSuppression = null;

    /**
     * @var Collection<int, TraductionOeuvre>
     */
    #[ORM\OneToMany(targetEntity: TraductionOeuvre::class, mappedBy: 'employe')]
    private Collection $traductionoeuvres;

    /**
     * @var Collection<int, TraductionExpo>
     */
    #[ORM\OneToMany(targetEntity: TraductionExpo::class, mappedBy: 'employe')]
    private Collection $traductionexpos;

    /**
     * @var Collection<int, TraductionContenuEnrichi>
     */
    #[ORM\OneToMany(targetEntity: TraductionContenuEnrichi::class, mappedBy: 'employe')]
    private Collection $traductionContenuEnrichis;

    /**
     * @var Collection<int, TraductionArtiste>
     */
    #[ORM\OneToMany(targetEntity: TraductionArtiste::class, mappedBy: 'employe')]
    private Collection $traductionartistes;

    /**
     * @var Collection<int, Oeuvre>
     */
    #[ORM\OneToMany(targetEntity: Oeuvre::class, mappedBy: 'employe')]
    private Collection $oeuvres;

    /**
     * @var Collection<int, Exposition>
     */
    #[ORM\OneToMany(targetEntity: Exposition::class, mappedBy: 'employe')]
    private Collection $expositions;

    #[ORM\ManyToOne(targetEntity: Fonction::class, inversedBy: 'employes')]
    #[ORM\JoinColumn(name: 'idFonction', referencedColumnName: 'idFonction', nullable: false)]
    private ?Fonction $fonction = null;

    /**
     * @var Collection<int, ContenuEnrichi>
     */
    #[ORM\OneToMany(targetEntity: ContenuEnrichi::class, mappedBy: 'employe')]
    private Collection $contenuEnrichis;

    /**
     * @var Collection<int, Artiste>
     */
    #[ORM\OneToMany(targetEntity: Artiste::class, mappedBy: 'employe')]
    private Collection $artistes;

    public function __construct()
    {
        $this->dateCreation = new \DateTime();
        $this->actif = true;
        $this->supprime = false;
        $this->traductionoeuvres = new ArrayCollection();
        $this->traductionexpos = new ArrayCollection();
        $this->traductionContenuEnrichis = new ArrayCollection();
        $this->traductionartistes = new ArrayCollection();
        $this->oeuvres = new ArrayCollection();
        $this->expositions = new ArrayCollection();
        $this->contenuEnrichis = new ArrayCollection();
        $this->artistes = new ArrayCollection();
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->login;
    }

    public function getRoles(): array
    {
        return ['ROLE_' . strtoupper($this->role)];
    }

    public function getPassword(): ?string
    {
        return $this->mdp;
    }

    public function eraseCredentials(): void
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): static
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(?bool $actif): static
    {
        $this->actif = $actif;

        return $this;
    }

    public function getSupprime(): ?bool
    {
        return $this->supprime;
    }

    public function setSupprime(?bool $supprime): static
    {
        $this->supprime = $supprime;

        return $this;
    }

    public function getDateCreation(): ?\DateTime
    {
        return $this->dateCreation;
    }

    public function setDateCreation(?\DateTime $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateSuppression(): ?\DateTime
    {
        return $this->dateSuppression;
    }

    public function setDateSuppression(?\DateTime $dateSuppression): static
    {
        $this->dateSuppression = $dateSuppression;

        return $this;
    }

    /**
     * @return Collection<int, TraductionOeuvre>
     */
    public function getTraductionoeuvres(): Collection
    {
        return $this->traductionoeuvres;
    }

    public function addTraductionoeuvre(TraductionOeuvre $traductionoeuvre): static
    {
        if (!$this->traductionoeuvres->contains($traductionoeuvre)) {
            $this->traductionoeuvres->add($traductionoeuvre);
            $traductionoeuvre->setEmploye($this);
        }

        return $this;
    }

    public function removeTraductionoeuvre(TraductionOeuvre $traductionoeuvre): static
    {
        if ($this->traductionoeuvres->removeElement($traductionoeuvre)) {
            // set the owning side to null (unless already changed)
            if ($traductionoeuvre->getEmploye() === $this) {
                $traductionoeuvre->setEmploye(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TraductionExpo>
     */
    public function getTraductionExpos(): Collection
    {
        return $this->traductionexpos;
    }

    public function addTraductionexpo(TraductionExpo $traductionexpo): static
    {
        if (!$this->traductionexpos->contains($traductionexpo)) {
            $this->traductionexpos->add($traductionexpo);
            $traductionexpo->setEmploye($this);
        }

        return $this;
    }

    public function removeTraductionexpo(TraductionExpo $traductionexpo): static
    {
        if ($this->traductionexpos->removeElement($traductionexpo)) {
            // set the owning side to null (unless already changed)
            if ($traductionexpo->getEmploye() === $this) {
                $traductionexpo->setEmploye(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TraductionContenuEnrichi>
     */
    public function getTraductionContenuEnrichis(): Collection
    {
        return $this->traductionContenuEnrichis;
    }

    public function addTraductionContenuEnrichy(TraductionContenuEnrichi $traductionContenuEnrichy): static
    {
        if (!$this->traductionContenuEnrichis->contains($traductionContenuEnrichy)) {
            $this->traductionContenuEnrichis->add($traductionContenuEnrichy);
            $traductionContenuEnrichy->setEmploye($this);
        }

        return $this;
    }

    public function removeTraductionContenuEnrichy(TraductionContenuEnrichi $traductionContenuEnrichy): static
    {
        if ($this->traductionContenuEnrichis->removeElement($traductionContenuEnrichy)) {
            // set the owning side to null (unless already changed)
            if ($traductionContenuEnrichy->getEmploye() === $this) {
                $traductionContenuEnrichy->setEmploye(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TraductionArtiste>
     */
    public function getTraductionArtistes(): Collection
    {
        return $this->traductionartistes;
    }

    public function addTraductionArtiste(TraductionArtiste $traductionartiste): static
    {
        if (!$this->traductionartistes->contains($traductionartiste)) {
            $this->traductionartistes->add($traductionartiste);
            $traductionartiste->setEmploye($this);
        }

        return $this;
    }

    public function removeTraductionartiste(TraductionArtiste $traductionartiste): static
    {
        if ($this->traductionartistes->removeElement($traductionartiste)) {
            // set the owning side to null (unless already changed)
            if ($traductionartiste->getEmploye() === $this) {
                $traductionartiste->setEmploye(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Oeuvre>
     */
    public function getOeuvres(): Collection
    {
        return $this->oeuvres;
    }

    public function addOeuvre(Oeuvre $oeuvre): static
    {
        if (!$this->oeuvres->contains($oeuvre)) {
            $this->oeuvres->add($oeuvre);
            $oeuvre->setEmploye($this);
        }

        return $this;
    }

    public function removeOeuvre(Oeuvre $oeuvre): static
    {
        if ($this->oeuvres->removeElement($oeuvre)) {
            // set the owning side to null (unless already changed)
            if ($oeuvre->getEmploye() === $this) {
                $oeuvre->setEmploye(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Exposition>
     */
    public function getExpositions(): Collection
    {
        return $this->expositions;
    }

    public function addExposition(Exposition $exposition): static
    {
        if (!$this->expositions->contains($exposition)) {
            $this->expositions->add($exposition);
            $exposition->setEmploye($this);
        }

        return $this;
    }

    public function removeExposition(Exposition $exposition): static
    {
        if ($this->expositions->removeElement($exposition)) {
            // set the owning side to null (unless already changed)
            if ($exposition->getEmploye() === $this) {
                $exposition->setEmploye(null);
            }
        }

        return $this;
    }

    public function getFonction(): ?Fonction
    {
        return $this->fonction;
    }

    public function setFonction(?Fonction $fonction): static
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * @return Collection<int, ContenuEnrichi>
     */
    public function getContenuEnrichis(): Collection
    {
        return $this->contenuEnrichis;
    }

    public function addContenuEnrichi(ContenuEnrichi $contenuEnrichi): static
    {
        if (!$this->contenuEnrichis->contains($contenuEnrichi)) {
            $this->contenuEnrichis->add($contenuEnrichi);
            $contenuEnrichi->setEmploye($this);
        }

        return $this;
    }

    public function removeContenuEnrichi(ContenuEnrichi $contenuEnrichi): static
    {
        if ($this->contenuEnrichis->removeElement($contenuEnrichi)) {
            // set the owning side to null (unless already changed)
            if ($contenuEnrichi->getEmploye() === $this) {
                $contenuEnrichi->setEmploye(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Artiste>
     */
    public function getArtistes(): Collection
    {
        return $this->artistes;
    }

    public function addArtiste(Artiste $artiste): static
    {
        if (!$this->artistes->contains($artiste)) {
            $this->artistes->add($artiste);
            $artiste->setEmploye($this);
        }

        return $this;
    }

    public function removeArtiste(Artiste $artiste): static
    {
        if ($this->artistes->removeElement($artiste)) {
            // set the owning side to null (unless already changed)
            if ($artiste->getEmploye() === $this) {
                $artiste->setEmploye(null);
            }
        }

        return $this;
    }
    public function __serialize(): array
    {
        return [
            'id' => $this->id,
            'login' => $this->login,
            'mdp' => $this->mdp,
            'role' => $this->role,
            'actif' => $this->actif,
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->id = $data['id'];
        $this->login = $data['login'];
        $this->mdp = $data['mdp'];
        $this->role = $data['role'];
        $this->actif = $data['actif'];
    }
}
