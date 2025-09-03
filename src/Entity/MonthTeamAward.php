<?php

namespace App\Entity;

use App\Repository\MonthTeamAwardRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MonthTeamAwardRepository::class)]
class MonthTeamAward
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'monthTeamAwards')]
    private ?Months $month = null;

    #[ORM\ManyToOne(inversedBy: 'monthTeamAwards')]
    private ?Team $bestTeam = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMonth(): ?Months
    {
        return $this->month;
    }

    public function setMonth(?Months $month): static
    {
        $this->month = $month;

        return $this;
    }

    public function getBestTeam(): ?Team
    {
        return $this->bestTeam;
    }

    public function setBestTeam(?Team $bestTeam): static
    {
        $this->bestTeam = $bestTeam;

        return $this;
    }
}
