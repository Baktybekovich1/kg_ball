<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TestApiRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestApiRepository::class)]
#[ApiResource]
class TestApi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ls = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bottleQ = null;

    #[ORM\Column(nullable: true)]
    private ?int $sum = null;

    #[ORM\Column(nullable: true)]
    private ?int $tariff = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLs(): ?string
    {
        return $this->ls;
    }

    public function setLs(?string $ls): static
    {
        $this->ls = $ls;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getBottleQ(): ?string
    {
        return $this->bottleQ;
    }

    public function setBottleQ(?string $bottleQ): static
    {
        $this->bottleQ = $bottleQ;

        return $this;
    }

    public function getSum(): ?int
    {
        return $this->sum;
    }

    public function setSum(?int $sum): static
    {
        $this->sum = $sum;

        return $this;
    }

    public function getTariff(): ?int
    {
        return $this->tariff;
    }

    public function setTariff(?int $tariff): static
    {
        $this->tariff = $tariff;

        return $this;
    }
}
