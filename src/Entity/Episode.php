<?php

namespace App\Entity;

use App\Repository\EpisodeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EpisodeRepository::class)
 */
class Episode
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\Column(type="text")
     */
    private $sumary;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $url;

    /**
     * @ORM\Column(type="date")
     */
    private $release;

    /**
     * @ORM\Column(type="date")
     */
    private $upload;

    /**
     * @ORM\ManyToOne(targetEntity=Season::class, inversedBy="episodes")
     */
    private $ofSeason;

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

    public function getSumary(): ?string
    {
        return $this->sumary;
    }

    public function setSumary(string $sumary): self
    {
        $this->sumary = $sumary;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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

    public function getUpload(): ?\DateTimeInterface
    {
        return $this->upload;
    }

    public function setUpload(\DateTimeInterface $upload): self
    {
        $this->upload = $upload;

        return $this;
    }

    public function getOfSeason(): ?Season
    {
        return $this->ofSeason;
    }

    public function setOfSeason(?Season $ofSeason): self
    {
        $this->ofSeason = $ofSeason;

        return $this;
    }
}
