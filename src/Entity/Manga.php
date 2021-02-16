<?php

namespace App\Entity;

use App\Repository\MangaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MangaRepository::class)
 */
class Manga
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
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $year;

    /**
     * @ORM\ManyToMany(targetEntity=Person::class, inversedBy="workedOn")
     */
    private $workedBy;

    /**
     * @ORM\OneToMany(targetEntity=Volume::class, mappedBy="ofManga", orphanRemoval=true)
     */
    private $volumes;

    /**
     * @ORM\ManyToOne(targetEntity=Theme::class, inversedBy="mangaTheme")
     * @ORM\JoinColumn(nullable=false)
     */
    private $theme;

    public function __construct()
    {
        $this->workedBy = new ArrayCollection();
        $this->volumes = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getYear(): ?\DateTimeInterface
    {
        return $this->year;
    }

    public function setYear(\DateTimeInterface $year): self
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
     * @return Collection|Volume[]
     */
    public function getVolumes(): Collection
    {
        return $this->volumes;
    }

    public function addVolume(Volume $volume): self
    {
        if (!$this->volumes->contains($volume)) {
            $this->volumes[] = $volume;
            $volume->setOfManga($this);
        }

        return $this;
    }

    public function removeVolume(Volume $volume): self
    {
        if ($this->volumes->removeElement($volume)) {
            // set the owning side to null (unless already changed)
            if ($volume->getOfManga() === $this) {
                $volume->setOfManga(null);
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
