<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\GoalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GoalRepository::class)]
#[ApiResource]
class Goal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'goals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Player $player = null;

    #[ORM\ManyToOne(inversedBy: 'goals')]
    private ?Game $game = null;

    #[ORM\ManyToOne( targetEntity: Team::class, inversedBy: 'goals')]
    private ?Team $team = null;

    #[ORM\ManyToOne(inversedBy: 'goals')]
    private ?TypeOfGoal $typeOfGoal = null;

    #[ORM\OneToMany(targetEntity: Assist::class, mappedBy: 'goal')]
    private Collection $assists;

    public function __toString(): string
    {
        return
            $this->player->getName() . ' ' .
            $this->getGame()->getWinnerTeam()->getTitle() . ' VS ' .
            $this->getGame()->getLoserTeam()->getTitle() . ' ' .
            $this->getTypeOfGoal()->getName() . ' in ' .
            $this->getGame()->getTourney()->getTitle()
            ?? 'Unnamed Goal Author';
    }

    public function __construct()
    {
        $this->assists = new ArrayCollection();
    }

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

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): static
    {
        $this->game = $game;

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

    public function getTypeOfGoal(): ?TypeOfGoal
    {
        return $this->typeOfGoal;
    }

    public function setTypeOfGoal(?TypeOfGoal $typeOfGoal): static
    {
        $this->typeOfGoal = $typeOfGoal;

        return $this;
    }

    /**
     * @return Collection<int, Assist>
     */
    public function getAssists(): Collection
    {
        return $this->assists;
    }

    public function addAssist(Assist $assist): static
    {
        if (!$this->assists->contains($assist)) {
            $this->assists->add($assist);
            $assist->setGoal($this);
        }

        return $this;
    }

    public function removeAssist(Assist $assist): static
    {
        if ($this->assists->removeElement($assist)) {
            // set the owning side to null (unless already changed)
            if ($assist->getGoal() === $this) {
                $assist->setGoal(null);
            }
        }

        return $this;
    }
}
