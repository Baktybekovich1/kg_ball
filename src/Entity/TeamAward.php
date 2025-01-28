<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TeamAwardRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamAwardRepository::class)]
#[ApiResource]
class TeamAward
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'teamAwards')]
    private ?Team $team = null;

    #[ORM\ManyToOne(inversedBy: 'teamAwards')]
    private ?AwardForTeam $awardForTeam = null;

    #[ORM\ManyToOne(inversedBy: 'teamAwards')]
    private ?Tourney $tourney = null;




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

    public function getAwardForTeam(): ?AwardForTeam
    {
        return $this->awardForTeam;
    }

    public function setAwardForTeam(?AwardForTeam $awardForTeam): static
    {
        $this->awardForTeam = $awardForTeam;

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
}
