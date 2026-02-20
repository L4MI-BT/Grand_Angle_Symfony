<?php

namespace App\Entity;

use App\Repository\EspaceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EspaceRepository::class)]
class Espace
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 250)]
    private ?string $nomEspace = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $superficieM2 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEspace(): ?string
    {
        return $this->nomEspace;
    }

    public function setNomEspace(string $nomEspace): static
    {
        $this->nomEspace = $nomEspace;

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

    public function getSuperficieM2(): ?string
    {
        return $this->superficieM2;
    }

    public function setSuperficieM2(?string $superficieM2): static
    {
        $this->superficieM2 = $superficieM2;

        return $this;
    }
}
