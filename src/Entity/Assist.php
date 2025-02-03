<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AssistRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssistRepository::class)]
#[ApiResource]
class Assist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'assists')]
    private ?Player $player = null;

    #[ORM\ManyToOne(inversedBy: 'assists')]
    private ?Goal $goal = null;

    #[ORM\ManyToOne( targetEntity: Team::class,inversedBy: 'assists')]
    private ?Team $team = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): static
    {
        $this->player = $player;

        return $this;
    }

    public function getGoal(): ?Goal
    {
        return $this->goal;
    }

    public function setGoal(?Goal $goal): static
    {
        $this->goal = $goal;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): static
    {
        $this->team = $team;

        return $this;
    }
}
