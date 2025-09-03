<?php

namespace App\Entity;

use App\Repository\MonthsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MonthsRepository::class)]
class Months
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $startDate = null;

    #[ORM\Column(length: 255)]
    private ?string $endDate = null;

    #[ORM\Column]
    private ?int $year = null;

    /**
     * @var Collection<int, MonthTeamAward>
     */
    #[ORM\OneToMany(targetEntity: MonthTeamAward::class, mappedBy: 'month')]
    private Collection $monthTeamAwards;

    /**
     * @var Collection<int, MonthPlayerAward>
     */
    #[ORM\OneToMany(targetEntity: MonthPlayerAward::class, mappedBy: 'month')]
    private Collection $monthPlayerAwards;

    public function __construct()
    {
        $this->monthTeamAwards = new ArrayCollection();
        $this->monthPlayerAwards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    public function setStartDate(string $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    public function setEndDate(string $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return Collection<int, MonthTeamAward>
     */
    public function getMonthTeamAwards(): Collection
    {
        return $this->monthTeamAwards;
    }

    public function addMonthTeamAward(MonthTeamAward $monthTeamAward): static
    {
        if (!$this->monthTeamAwards->contains($monthTeamAward)) {
            $this->monthTeamAwards->add($monthTeamAward);
            $monthTeamAward->setMonth($this);
        }

        return $this;
    }

    public function removeMonthTeamAward(MonthTeamAward $monthTeamAward): static
    {
        if ($this->monthTeamAwards->removeElement($monthTeamAward)) {
            // set the owning side to null (unless already changed)
            if ($monthTeamAward->getMonth() === $this) {
                $monthTeamAward->setMonth(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MonthPlayerAward>
     */
    public function getMonthPlayerAwards(): Collection
    {
        return $this->monthPlayerAwards;
    }

    public function addMonthPlayerAward(MonthPlayerAward $monthPlayerAward): static
    {
        if (!$this->monthPlayerAwards->contains($monthPlayerAward)) {
            $this->monthPlayerAwards->add($monthPlayerAward);
            $monthPlayerAward->setMonth($this);
        }

        return $this;
    }

    public function removeMonthPlayerAward(MonthPlayerAward $monthPlayerAward): static
    {
        if ($this->monthPlayerAwards->removeElement($monthPlayerAward)) {
            // set the owning side to null (unless already changed)
            if ($monthPlayerAward->getMonth() === $this) {
                $monthPlayerAward->setMonth(null);
            }
        }

        return $this;
    }
}
