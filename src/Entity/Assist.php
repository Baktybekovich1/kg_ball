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

    #[ORM\ManyToOne(targetEntity: Player::class ,inversedBy: 'assists')]
    private ?Player $player = null;

    #[ORM\OneToOne(targetEntity: Goal::class, inversedBy: 'assist')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Goal $goal = null;

    #[ORM\ManyToOne( targetEntity: Team::class,inversedBy: 'assists')]
    private ?Team $team = null;

    #[ORM\ManyToOne( targetEntity: Team::class,inversedBy: 'assists')]
    private ?Team $vs_team = null;

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
        $this->team = $this->getGoal()->getPlayer()->getTeam();
        $a = $this->getGoal()->getGame()->getWinnerTeam();
        $b = $this->getGoal()->getGame()->getLoserTeam();
        if ($a === $this->getPlayer()->getTeam()) {
            $this->team = $this->getPlayer()->getTeam();
            $this->vs_team = $this->getGoal()->getGame()->getLoserTeam();
        } else {
            $this->team = $this->getPlayer()->getTeam();
            $this->vs_team = $this->getGoal()->getGame()->getWinnerTeam();
        }

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function getVsTeam(): ?Team
    {
        return $this->vs_team;
    }

    public function setTeam(?Team $team): void
    {
        $this->team = $team;
    }

    public function setVsTeam(?Team $vs_team): void
    {
        $this->vs_team = $vs_team;
    }




}
