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

    #[ORM\OneToOne(targetEntity: Assist::class, mappedBy: 'goal', cascade: ['persist', 'remove'])]
    private ?Assist $assist = null;

    #[ORM\ManyToOne(targetEntity: Team::class, inversedBy: 'goals')]
    private ?Team $team = null;

    #[ORM\ManyToOne(targetEntity: Team::class, inversedBy: 'goals')]
    private ?Team $vs_team = null;

    #[ORM\ManyToOne(inversedBy: 'goals')]
    private ?TypeOfGoal $typeOfGoal = null;


    public function __toString(): string
    {
        return
            $this->getId() .' ' .
            $this->player->getName() . ' ' .
            $this->getGame()->getWinnerTeam()->getTitle() . ' VS ' .
            $this->getGame()->getLoserTeam()->getTitle() . ' ' .
            $this->getTypeOfGoal()->getName() . ' in ' .
            $this->getGame()->getTourney()->getTitle()
            ?? 'Unnamed Goal Author';
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
        $this->team = $this->getPlayer()->getTeam();
        $a = $this->getGame()->getWinnerTeam();
        $b = $this->getGame()->getLoserTeam();
        if ($a === $this->getPlayer()->getTeam()) {
            $this->team = $this->getPlayer()->getTeam();
            $this->vs_team = $this->getGame()->getLoserTeam();
        } else {
            $this->team = $this->getPlayer()->getTeam();
            $this->vs_team = $this->getGame()->getWinnerTeam();
        }

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

    public function getAssist(): ?Assist
    {
        return $this->assist;
    }

    public function setAssist(?Assist $assist): static
    {
        // Устанавливаем связь в обеих сторонах
        if ($assist !== null && $assist->getGoal() !== $this) {
            $assist->setGoal($this);
        }

        $this->assist = $assist;

        return $this;
    }

    public function getVsTeam(): ?Team
    {
        return $this->vs_team;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }


}
