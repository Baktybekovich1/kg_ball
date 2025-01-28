<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AwardForTeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AwardForTeamRepository::class)]
#[ApiResource]
class AwardForTeam
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    /**
     * @var Collection<int, TeamAward>
     */
    #[ORM\OneToMany(targetEntity: TeamAward::class, mappedBy: 'awardForTeam')]
    private Collection $teamAwards;


    public function __toString(): string
    {
        return $this->title ?? 'Team Award For Team';
    }

    public function __construct()
    {
        $this->teamAwards = new ArrayCollection();
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

    /**
     * @return Collection<int, TeamAward>
     */
    public function getTeamAwards(): Collection
    {
        return $this->teamAwards;
    }

    public function addTeamAward(TeamAward $teamAward): static
    {
        if (!$this->teamAwards->contains($teamAward)) {
            $this->teamAwards->add($teamAward);
            $teamAward->setAwardForTeam($this);
        }

        return $this;
    }

    public function removeTeamAward(TeamAward $teamAward): static
    {
        if ($this->teamAwards->removeElement($teamAward)) {
            // set the owning side to null (unless already changed)
            if ($teamAward->getAwardForTeam() === $this) {
                $teamAward->setAwardForTeam(null);
            }
        }

        return $this;
    }
}
