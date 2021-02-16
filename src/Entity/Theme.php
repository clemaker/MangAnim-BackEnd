<?php

namespace App\Entity;

use App\Repository\ThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ThemeRepository::class)
 */
class Theme
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity=Manga::class, mappedBy="theme")
     */
    private $mangaTheme;

    /**
     * @ORM\OneToMany(targetEntity=anime::class, mappedBy="theme")
     */
    private $animeTheme;

    public function __construct()
    {
        $this->mangaTheme = new ArrayCollection();
        $this->animeTheme = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|Manga[]
     */
    public function getMangaTheme(): Collection
    {
        return $this->mangaTheme;
    }

    public function addMangaTheme(Manga $mangaTheme): self
    {
        if (!$this->mangaTheme->contains($mangaTheme)) {
            $this->mangaTheme[] = $mangaTheme;
            $mangaTheme->setTheme($this);
        }

        return $this;
    }

    public function removeMangaTheme(Manga $mangaTheme): self
    {
        if ($this->mangaTheme->removeElement($mangaTheme)) {
            // set the owning side to null (unless already changed)
            if ($mangaTheme->getTheme() === $this) {
                $mangaTheme->setTheme(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|anime[]
     */
    public function getAnimeTheme(): Collection
    {
        return $this->animeTheme;
    }

    public function addAnimeTheme(anime $animeTheme): self
    {
        if (!$this->animeTheme->contains($animeTheme)) {
            $this->animeTheme[] = $animeTheme;
            $animeTheme->setTheme($this);
        }

        return $this;
    }

    public function removeAnimeTheme(anime $animeTheme): self
    {
        if ($this->animeTheme->removeElement($animeTheme)) {
            // set the owning side to null (unless already changed)
            if ($animeTheme->getTheme() === $this) {
                $animeTheme->setTheme(null);
            }
        }

        return $this;
    }
}
