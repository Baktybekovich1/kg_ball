<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TourneyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TourneyRepository::class)]
#[ApiResource]
class Tourney
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?int $teams_sum = null;

    #[ORM\Column(length: 255)]
    private ?string $date = null;

    #[ORM\Column]
    private ?int $year = null;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'tourney')]
    private Collection $games;

    public function __toString(): string
    {
        return $this->title ?? 'Unnamed Team';
    }
    public function __construct()
    {
        $this->games = new ArrayCollection();
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

    public function getTeamsSum(): ?int
    {
        return $this->teams_sum;
    }

    public function setTeamsSum(int $teams_sum): static
    {
        $this->teams_sum = $teams_sum;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): static
    {
        $this->date = $date;

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
     * @return Collection<int, Game>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): static
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->setTourney($this);
        }

        return $this;
    }

    public function removeGame(Game $game): static
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getTourney() === $this) {
                $game->setTourney(null);
            }
        }

        return $this;
    }
}
