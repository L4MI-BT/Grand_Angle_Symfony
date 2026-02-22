<?php

namespace App\Entity;

use App\Repository\LangueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LangueRepository::class)]
#[ORM\Table(name: 'langue')]
class Langue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'idLangue')]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $img = null;

    /**
     * @var Collection<int, TraductionOeuvre>
     */
    #[ORM\OneToMany(targetEntity: TraductionOeuvre::class, mappedBy: 'langue')]
    private Collection $traductionoeuvres;

    /**
     * @var Collection<int, TraductionExpo>
     */
    #[ORM\OneToMany(targetEntity: TraductionExpo::class, mappedBy: 'langue')]
    private Collection $traductionexpos;

    /**
     * @var Collection<int, TraductionContenuEnrichi>
     */
    #[ORM\OneToMany(targetEntity: TraductionContenuEnrichi::class, mappedBy: 'langue')]
    private Collection $traductionContenuEnrichis;

    /**
     * @var Collection<int, TraductionArtiste>
     */
    #[ORM\OneToMany(targetEntity: TraductionArtiste::class, mappedBy: 'langue')]
    private Collection $traductionartistes;

    #[ORM\Column(length: 5)]
    private ?string $code = null;

    public function __construct()
    {
        $this->traductionoeuvres = new ArrayCollection();
        $this->traductionexpos = new ArrayCollection();
        $this->traductionContenuEnrichis = new ArrayCollection();
        $this->traductionartistes = new ArrayCollection();
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

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): static
    {
        $this->img = $img;

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
            $traductionoeuvre->setLangue($this);
        }

        return $this;
    }

    public function removeTraductionoeuvre(TraductionOeuvre $traductionoeuvre): static
    {
        if ($this->traductionoeuvres->removeElement($traductionoeuvre)) {
            // set the owning side to null (unless already changed)
            if ($traductionoeuvre->getLangue() === $this) {
                $traductionoeuvre->setLangue(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TraductionExpo>
     */
    public function getTraductionexpos(): Collection
    {
        return $this->traductionexpos;
    }

    public function addTraductionexpo(TraductionExpo $traductionexpo): static
    {
        if (!$this->traductionexpos->contains($traductionexpo)) {
            $this->traductionexpos->add($traductionexpo);
            $traductionexpo->setLangue($this);
        }

        return $this;
    }

    public function removeTraductionexpo(TraductionExpo $traductionexpo): static
    {
        if ($this->traductionexpos->removeElement($traductionexpo)) {
            // set the owning side to null (unless already changed)
            if ($traductionexpo->getLangue() === $this) {
                $traductionexpo->setLangue(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TraductionContenueEnrichie>
     */
    public function getTraductionContenuEnrichis(): Collection
    {
        return $this->traductionContenuEnrichis;
    }

    public function addTraductionContenueEnrichy(TraductionContenuEnrichi $traductionContenuEnrichy): static
    {
        if (!$this->traductionContenuEnrichis->contains($traductionContenuEnrichy)) {
            $this->traductionContenuEnrichis->add($traductionContenuEnrichy);
            $traductionContenuEnrichy->setLangue($this);
        }

        return $this;
    }

    public function removeTraductionContenueEnrichy(TraductionContenuEnrichi $traductionContenuEnrichy): static
    {
        if ($this->traductionContenuEnrichis->removeElement($traductionContenuEnrichy)) {
            // set the owning side to null (unless already changed)
            if ($traductionContenuEnrichy->getLangue() === $this) {
                $traductionContenuEnrichy->setLangue(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TraductionArtiste>
     */
    public function getTraductionartistes(): Collection
    {
        return $this->traductionartistes;
    }

    public function addTraductionartiste(TraductionArtiste $traductionartiste): static
    {
        if (!$this->traductionartistes->contains($traductionartiste)) {
            $this->traductionartistes->add($traductionartiste);
            $traductionartiste->setLangue($this);
        }

        return $this;
    }

    public function removeTraductionartiste(TraductionArtiste $traductionartiste): static
    {
        if ($this->traductionartistes->removeElement($traductionartiste)) {
            // set the owning side to null (unless already changed)
            if ($traductionartiste->getLangue() === $this) {
                $traductionartiste->setLangue(null);
            }
        }

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }
}
