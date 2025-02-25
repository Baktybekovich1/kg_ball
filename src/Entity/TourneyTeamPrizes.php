<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TourneyTeamPrizesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TourneyTeamPrizesRepository::class)]
#[ApiResource]
class TourneyTeamPrizes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'tourneyTeamPrizes')]
    private ?Team $firstPosition = null;

    #[ORM\ManyToOne(inversedBy: 'tourneyTeamPrizes')]
    private ?Team $secondPosition = null;

    #[ORM\ManyToOne(inversedBy: 'tourneyTeamPrizes')]
    private ?Team $thirdPosition = null;

    #[ORM\OneToOne(inversedBy: 'tourneyTeamPrizes', cascade: ['persist', 'remove'])]
    private ?Tourney $tourney = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstPosition(): ?Team
    {
        return $this->firstPosition;
    }

    public function setFirstPosition(?Team $firstPosition): void
    {
        $this->firstPosition = $firstPosition;
    }



    public function getSecondPosition(): ?Team
    {
        return $this->secondPosition;
    }

    public function setSecondPosition(?Team $secondPosition): static
    {
        $this->secondPosition = $secondPosition;

        return $this;
    }

    public function getThirdPosition(): ?Team
    {
        return $this->thirdPosition;
    }

    public function setThirdPosition(?Team $thirdPosition): static
    {
        $this->thirdPosition = $thirdPosition;

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
