<?php

namespace App\Entity;

use App\Repository\MonthPlayerAwardRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MonthPlayerAwardRepository::class)]
class MonthPlayerAward
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'monthPlayerAwards')]
    private ?Player $bombardier = null;

    #[ORM\ManyToOne(inversedBy: 'monthPlayerAwards')]
    private ?Player $assistant = null;

    #[ORM\ManyToOne]
    private ?Player $theBest = null;

    #[ORM\ManyToOne]
    private ?Player $goalkeeper = null;

    #[ORM\ManyToOne]
    private ?Player $defender = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $startDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $endDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBombardier(): ?Player
    {
        return $this->bombardier;
    }

    public function setBombardier(?Player $bombardier): static
    {
        $this->bombardier = $bombardier;

        return $this;
    }

    public function getAssistant(): ?Player
    {
        return $this->assistant;
    }

    public function setAssistant(?Player $assistant): static
    {
        $this->assistant = $assistant;

        return $this;
    }

    public function getTheBest(): ?Player
    {
        return $this->theBest;
    }

    public function setTheBest(?Player $theBest): static
    {
        $this->theBest = $theBest;

        return $this;
    }

    public function getGoalkeeper(): ?Player
    {
        return $this->goalkeeper;
    }

    public function setGoalkeeper(?Player $goalkeeper): static
    {
        $this->goalkeeper = $goalkeeper;

        return $this;
    }

    public function getDefender(): ?Player
    {
        return $this->defender;
    }

    public function setDefender(?Player $defender): static
    {
        $this->defender = $defender;

        return $this;
    }

    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    public function setStartDate(?string $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    public function setEndDate(?string $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }
}
