<?php

namespace App\Entity;

use App\Repository\ScanRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ScanRepository::class)
 */
class Scan
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity=Chapter::class, inversedBy="scans")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ofChapter;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getOfChapter(): ?Chapter
    {
        return $this->ofChapter;
    }

    public function setOfChapter(?Chapter $ofChapter): self
    {
        $this->ofChapter = $ofChapter;

        return $this;
    }
}
