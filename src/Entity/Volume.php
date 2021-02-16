<?php

namespace App\Entity;

use App\Repository\VolumeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VolumeRepository::class)
 */
class Volume
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
     * @ORM\Column(type="date")
     */
    private $release;

    /**
     * @ORM\ManyToOne(targetEntity=Manga::class, inversedBy="volumes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ofManga;

    /**
     * @ORM\OneToMany(targetEntity=Chapter::class, mappedBy="ofVolume", orphanRemoval=true)
     */
    private $chapters;

    public function __construct()
    {
        $this->chapters = new ArrayCollection();
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

    public function getRelease(): ?\DateTimeInterface
    {
        return $this->release;
    }

    public function setRelease(\DateTimeInterface $release): self
    {
        $this->release = $release;

        return $this;
    }

    public function getOfManga(): ?Manga
    {
        return $this->ofManga;
    }

    public function setOfManga(?Manga $ofManga): self
    {
        $this->ofManga = $ofManga;

        return $this;
    }

    /**
     * @return Collection|Chapter[]
     */
    public function getChapters(): Collection
    {
        return $this->chapters;
    }

    public function addChapter(Chapter $chapter): self
    {
        if (!$this->chapters->contains($chapter)) {
            $this->chapters[] = $chapter;
            $chapter->setOfVolume($this);
        }

        return $this;
    }

    public function removeChapter(Chapter $chapter): self
    {
        if ($this->chapters->removeElement($chapter)) {
            // set the owning side to null (unless already changed)
            if ($chapter->getOfVolume() === $this) {
                $chapter->setOfVolume(null);
            }
        }

        return $this;
    }
}
