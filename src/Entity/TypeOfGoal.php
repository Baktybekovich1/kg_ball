<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TypeOfGoalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeOfGoalRepository::class)]
#[ApiResource]
class TypeOfGoal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Goal>
     */
    #[ORM\OneToMany(targetEntity: Goal::class, mappedBy: 'typeOfGoal')]
    private Collection $goals;

    public function __toString(): string
    {
        return $this->name ?? 'Unnamed Type of Goal';
    }
    public function __construct()
    {
        $this->goals = new ArrayCollection();
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
            $goal->setTypeOfGoal($this);
        }

        return $this;
    }

    public function removeGoal(Goal $goal): static
    {
        if ($this->goals->removeElement($goal)) {
            // set the owning side to null (unless already changed)
            if ($goal->getTypeOfGoal() === $this) {
                $goal->setTypeOfGoal(null);
            }
        }

        return $this;
    }
}
