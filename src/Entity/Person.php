<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonRepository::class)
 */
class Person
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $country;

    /**
     * @ORM\ManyToMany(targetEntity=Manga::class, mappedBy="workedBy")
     */
    private $workedOn;

    /**
     * @ORM\ManyToMany(targetEntity=Anime::class, mappedBy="workedBy")
     */
    private $animeWorkedOn;

    public function __construct()
    {
        $this->workedOn = new ArrayCollection();
        $this->animeWorkedOn = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|Manga[]
     */
    public function getWorkedOn(): Collection
    {
        return $this->workedOn;
    }

    public function addWorkedOn(Manga $workedOn): self
    {
        if (!$this->workedOn->contains($workedOn)) {
            $this->workedOn[] = $workedOn;
            $workedOn->addWorkedBy($this);
        }

        return $this;
    }

    public function removeWorkedOn(Manga $workedOn): self
    {
        if ($this->workedOn->removeElement($workedOn)) {
            $workedOn->removeWorkedBy($this);
        }

        return $this;
    }

    /**
     * @return Collection|Anime[]
     */
    public function getAnimeWorkedOn(): Collection
    {
        return $this->animeWorkedOn;
    }

    public function addAnimeWorkedOn(Anime $animeWorkedOn): self
    {
        if (!$this->animeWorkedOn->contains($animeWorkedOn)) {
            $this->animeWorkedOn[] = $animeWorkedOn;
            $animeWorkedOn->addWorkedBy($this);
        }

        return $this;
    }

    public function removeAnimeWorkedOn(Anime $animeWorkedOn): self
    {
        if ($this->animeWorkedOn->removeElement($animeWorkedOn)) {
            $animeWorkedOn->removeWorkedBy($this);
        }

        return $this;
    }
}
