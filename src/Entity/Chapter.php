<?php

namespace App\Entity;

use App\Repository\ChapterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChapterRepository::class)
 */
class Chapter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\Column(type="date")
     */
    private $upload;

    /**
     * @ORM\ManyToOne(targetEntity=Volume::class, inversedBy="chapters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ofVolume;

    /**
     * @ORM\OneToMany(targetEntity=Scan::class, mappedBy="ofChapter", orphanRemoval=true)
     */
    private $scans;

    public function __construct()
    {
        $this->scans = new ArrayCollection();
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

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getUpload(): ?\DateTimeInterface
    {
        return $this->upload;
    }

    public function setUpload(\DateTimeInterface $upload): self
    {
        $this->upload = $upload;

        return $this;
    }

    public function getOfVolume(): ?Volume
    {
        return $this->ofVolume;
    }

    public function setOfVolume(?Volume $ofVolume): self
    {
        $this->ofVolume = $ofVolume;

        return $this;
    }

    /**
     * @return Collection|Scan[]
     */
    public function getScans(): Collection
    {
        return $this->scans;
    }

    public function addScan(Scan $scan): self
    {
        if (!$this->scans->contains($scan)) {
            $this->scans[] = $scan;
            $scan->setOfChapter($this);
        }

        return $this;
    }

    public function removeScan(Scan $scan): self
    {
        if ($this->scans->removeElement($scan)) {
            // set the owning side to null (unless already changed)
            if ($scan->getOfChapter() === $this) {
                $scan->setOfChapter(null);
            }
        }

        return $this;
    }
}
