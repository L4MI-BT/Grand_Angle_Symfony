<?php

namespace App\Entity;

use App\Repository\OeuvreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OeuvreRepository::class)]
class Oeuvre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(nullable: true)]
    private ?int $anneeCreation = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $hauteurCm = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $largeurCm = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $profondeurCm = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateLivraisonPrevue = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateLivraisonReelle = null;

    #[ORM\Column(nullable: true)]
    private ?int $ordreVisite = null;

    #[ORM\Column(length: 500)]
    private ?string $urlQrCode = null;

    #[ORM\Column(length: 255)]
    private ?string $datetime = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $dateAjout = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getAnneeCreation(): ?int
    {
        return $this->anneeCreation;
    }

    public function setAnneeCreation(?int $anneeCreation): static
    {
        $this->anneeCreation = $anneeCreation;

        return $this;
    }

    public function getHauteurCm(): ?string
    {
        return $this->hauteurCm;
    }

    public function setHauteurCm(?string $hauteurCm): static
    {
        $this->hauteurCm = $hauteurCm;

        return $this;
    }

    public function getLargeurCm(): ?string
    {
        return $this->largeurCm;
    }

    public function setLargeurCm(?string $largeurCm): static
    {
        $this->largeurCm = $largeurCm;

        return $this;
    }

    public function getProfondeurCm(): ?string
    {
        return $this->profondeurCm;
    }

    public function setProfondeurCm(?string $profondeurCm): static
    {
        $this->profondeurCm = $profondeurCm;

        return $this;
    }

    public function getDateLivraisonPrevue(): ?\DateTime
    {
        return $this->dateLivraisonPrevue;
    }

    public function setDateLivraisonPrevue(?\DateTime $dateLivraisonPrevue): static
    {
        $this->dateLivraisonPrevue = $dateLivraisonPrevue;

        return $this;
    }

    public function getDateLivraisonReelle(): ?\DateTime
    {
        return $this->dateLivraisonReelle;
    }

    public function setDateLivraisonReelle(?\DateTime $dateLivraisonReelle): static
    {
        $this->dateLivraisonReelle = $dateLivraisonReelle;

        return $this;
    }

    public function getOrdreVisite(): ?int
    {
        return $this->ordreVisite;
    }

    public function setOrdreVisite(?int $ordreVisite): static
    {
        $this->ordreVisite = $ordreVisite;

        return $this;
    }

    public function getUrlQrCode(): ?string
    {
        return $this->urlQrCode;
    }

    public function setUrlQrCode(string $urlQrCode): static
    {
        $this->urlQrCode = $urlQrCode;

        return $this;
    }

    public function getDatetime(): ?string
    {
        return $this->datetime;
    }

    public function setDatetime(string $datetime): static
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getDateAjout(): ?\DateTime
    {
        return $this->dateAjout;
    }

    public function setDateAjout(?\DateTime $dateAjout): static
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }
}
