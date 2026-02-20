<?php

namespace App\Entity;

use App\Repository\EmplacementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmplacementRepository::class)]
class Emplacement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2, nullable: true)]
    private ?string $positionX = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2, nullable: true)]
    private ?string $positionY = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPositionX(): ?string
    {
        return $this->positionX;
    }

    public function setPositionX(?string $positionX): static
    {
        $this->positionX = $positionX;

        return $this;
    }

    public function getPositionY(): ?string
    {
        return $this->positionY;
    }

    public function setPositionY(?string $positionY): static
    {
        $this->positionY = $positionY;

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
}
