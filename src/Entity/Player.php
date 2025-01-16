<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
#[ApiResource]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\ManyToOne(inversedBy: 'players')]
    private ?Team $team = null;

    #[ORM\Column(length: 255)]
    private ?string $birthday = null;

    #[ORM\Column(length: 255)]
    private ?string $position = null;

    #[ORM\OneToMany(targetEntity: Goal::class, mappedBy: 'player', orphanRemoval: true)]
    private Collection $goals;


    #[ORM\OneToMany(targetEntity: Assist::class, mappedBy: 'player')]
    private Collection $assists;

    public function __construct()
    {
        $this->goals = new ArrayCollection();
        $this->assists = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name ?? 'Unnamed Player';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

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

    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    public function setBirthday(string $birthday): static
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): static
    {
        $this->position = $position;

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
            $goal->setPlayer($this);
        }

        return $this;
    }

    public function removeGoal(Goal $goal): static
    {
        if ($this->goals->removeElement($goal)) {
            // set the owning side to null (unless already changed)
            if ($goal->getPlayer() === $this) {
                $goal->setPlayer(null);
            }
        }

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
            $assist->setPlayer($this);
        }

        return $this;
    }

    public function removeAssist(Assist $assist): static
    {
        if ($this->assists->removeElement($assist)) {
            // set the owning side to null (unless already changed)
            if ($assist->getPlayer() === $this) {
                $assist->setPlayer(null);
            }
        }

        return $this;
    }
}
