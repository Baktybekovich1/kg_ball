<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TourneyPlayerPrizesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TourneyPlayerPrizesRepository::class)]
#[ApiResource]
class TourneyPlayerPrizes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'tourneyPlayerPrizes')]
    private ?Tourney $tourney = null;

    #[ORM\ManyToOne]
    private ?Player $bombardier = null;

    #[ORM\ManyToOne]
    private ?Player $assistant = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Player $theBest = null;

    #[ORM\ManyToOne]
    private ?Player $goalkeeper = null;

    #[ORM\ManyToOne]
    private ?Player $defender = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTourney(): ?Tourney
    {
        return $this->tourney;
    }

    public function setTourney(?Tourney $tourney): static
    {
        $this->tourney = $tourney;

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
}
