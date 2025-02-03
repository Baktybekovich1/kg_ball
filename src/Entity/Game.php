<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
#[ApiResource]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Team::class, inversedBy: 'games')]
    private ?Team $homeTeam = null;

    #[ORM\ManyToOne(targetEntity: Team::class,inversedBy: 'games')]
    private ?Team $awayTeam = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    private ?Tourney $tourney = null;

    #[ORM\OneToMany(targetEntity: Goal::class, mappedBy: 'game')]
    private Collection $goals;

    public function __toString(): string
    {
        return $this->homeTeam->getTitle() . 'VS' . $this->awayTeam->getTitle() . ' ' . $this->getTourney() . ' ' . $this->getTourney()->getDate() ?? 'Unnamed Team and opponent';
    }

    public function __construct()
    {
        $this->goals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHomeTeam(): ?Team
    {
        return $this->homeTeam;
    }

    public function setHomeTeam(?Team $homeTeam): void
    {
        $this->homeTeam = $homeTeam;
    }

    public function getAwayTeam(): ?Team
    {
        return $this->awayTeam;
    }

    public function setAwayTeam(?Team $awayTeam): void
    {
        $this->awayTeam = $awayTeam;
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

    public function getGoals(): Collection
    {
        return $this->goals;
    }

    public function addGoal(Goal $goal): static
    {
        if (!$this->goals->contains($goal)) {
            $this->goals->add($goal);
            $goal->setGame($this);
        }

        return $this;
    }

    public function removeGoal(Goal $goal): static
    {
        if ($this->goals->removeElement($goal)) {
            // set the owning side to null (unless already changed)
            if ($goal->getGame() === $this) {
                $goal->setGame(null);
            }
        }

        return $this;
    }
}
