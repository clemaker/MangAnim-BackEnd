<?php

namespace App\Entity;

use App\Repository\AnimeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnimeRepository::class)
 */
class Anime
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $sumary;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\ManyToMany(targetEntity=Person::class, inversedBy="animeWorkedOn")
     */
    private $workedBy;

    /**
     * @ORM\OneToMany(targetEntity=Season::class, mappedBy="ofAnime", orphanRemoval=true)
     */
    private $seasons;

    /**
     * @ORM\ManyToOne(targetEntity=Theme::class, inversedBy="animeTheme")
     * @ORM\JoinColumn(nullable=false)
     */
    private $theme;

    public function __construct()
    {
        $this->workedBy = new ArrayCollection();
        $this->seasons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSumary(): ?string
    {
        return $this->sumary;
    }

    public function setSumary(string $sumary): self
    {
        $this->sumary = $sumary;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return Collection|Person[]
     */
    public function getWorkedBy(): Collection
    {
        return $this->workedBy;
    }

    public function addWorkedBy(Person $workedBy): self
    {
        if (!$this->workedBy->contains($workedBy)) {
            $this->workedBy[] = $workedBy;
        }

        return $this;
    }

    public function removeWorkedBy(Person $workedBy): self
    {
        $this->workedBy->removeElement($workedBy);

        return $this;
    }

    /**
     * @return Collection|Season[]
     */
    public function getSeasons(): Collection
    {
        return $this->seasons;
    }

    public function addSeason(Season $season): self
    {
        if (!$this->seasons->contains($season)) {
            $this->seasons[] = $season;
            $season->setOfAnime($this);
        }

        return $this;
    }

    public function removeSeason(Season $season): self
    {
        if ($this->seasons->removeElement($season)) {
            // set the owning side to null (unless already changed)
            if ($season->getOfAnime() === $this) {
                $season->setOfAnime(null);
            }
        }

        return $this;
    }

    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    public function setTheme(?Theme $theme): self
    {
        $this->theme = $theme;

        return $this;
    }
}
