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

    #[ORM\ManyToOne(inversedBy: 'games')]
    private ?Team $team = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'games')]
    private ?self $opponent = null;


    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'opponent')]
    private Collection $games;

    #[ORM\Column]
    private ?bool $atHome = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    private ?Tourney $tourney = null;


    #[ORM\OneToMany(targetEntity: Goal::class, mappedBy: 'game')]
    private Collection $goals;

    public function __toString(): string
    {
        return $this->team->getTitle() ?? 'Unnamed Team and opponent';
    }

    public function __construct()
    {
        $this->games = new ArrayCollection();
        $this->goals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getOpponent(): ?self
    {
        return $this->opponent;
    }

    public function setOpponent(?self $opponent): static
    {
        $this->opponent = $opponent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(self $game): static
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->setOpponent($this);
        }

        return $this;
    }

    public function removeGame(self $game): static
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getOpponent() === $this) {
                $game->setOpponent(null);
            }
        }

        return $this;
    }

    public function isAtHome(): ?bool
    {
        return $this->atHome;
    }

    public function setAtHome(bool $atHome): static
    {
        $this->atHome = $atHome;

        return $this;
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

    /**
     * @return Collection<int, Goal>
     */
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
