<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
#[ApiResource]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $logo = null;

    #[ORM\OneToMany(targetEntity: Player::class, mappedBy: 'team')]
    private Collection $players;

    #[ORM\OneToMany(targetEntity: Goal::class, mappedBy: 'team')]
    private Collection $goals;

    #[ORM\OneToMany(targetEntity: Assist::class, mappedBy: 'team')]
    private Collection $assists;

    #[ORM\OneToMany(targetEntity: TourneyTeamPrizes::class, mappedBy: 'firstPosition')]
    private Collection $tourneyTeamPrizes;

    #[ORM\ManyToOne(inversedBy: 'teams')]
    private ?Liga $liga = null;

    public function __toString(): string
    {
        return $this->title ?? 'Unnamed Team';
    }

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->goals = new ArrayCollection();
        $this->assists = new ArrayCollection();
        $this->tourneyTeamPrizes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }


    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): static
    {
        if (!$this->players->contains($player)) {
            $this->players->add($player);
            $player->setTeam($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): static
    {
        if ($this->players->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getTeam() === $this) {
                $player->setTeam(null);
            }
        }

        return $this;
    }


    public function getGoals(): Collection
    {
        return $this->goals;
    }


    public function getAssists(): Collection
    {
        return $this->assists;
    }

    public function getTeamAwards(): Collection
    {
        return $this->teamAwards;
    }

    public function getTourneyTeamPrizes(): Collection
    {
        return $this->tourneyTeamPrizes;
    }

    public function addTourneyTeamPrize(TourneyTeamPrizes $tourneyTeamPrize): static
    {
        if (!$this->tourneyTeamPrizes->contains($tourneyTeamPrize)) {
            $this->tourneyTeamPrizes->add($tourneyTeamPrize);
            $tourneyTeamPrize->setFirstPosition($this);
        }

        return $this;
    }

    public function removeTourneyTeamPrize(TourneyTeamPrizes $tourneyTeamPrize): static
    {
        if ($this->tourneyTeamPrizes->removeElement($tourneyTeamPrize)) {
            // set the owning side to null (unless already changed)
            if ($tourneyTeamPrize->getFirstPosition() === $this) {
                $tourneyTeamPrize->setFirstPosition(null);
            }
        }

        return $this;
    }

    public function getLiga(): ?Liga
    {
        return $this->liga;
    }

    public function setLiga(?Liga $liga): static
    {
        $this->liga = $liga;

        return $this;
    }
}
