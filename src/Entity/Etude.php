<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtudeRepository")
 */
class Etude
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $creationDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="Etudes")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Plage", inversedBy="etudes")
     */
    private $EtudeHasPlage;

    public function __construct()
    {
        $this->EtudeHasPlage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Plage[]
     */
    public function getEtudeHasPlage(): Collection
    {
        return $this->EtudeHasPlage;
    }

    public function addEtudeHasPlage(Plage $etudeHasPlage): self
    {
        if (!$this->EtudeHasPlage->contains($etudeHasPlage)) {
            $this->EtudeHasPlage[] = $etudeHasPlage;
        }

        return $this;
    }

    public function removeEtudeHasPlage(Plage $etudeHasPlage): self
    {
        if ($this->EtudeHasPlage->contains($etudeHasPlage)) {
            $this->EtudeHasPlage->removeElement($etudeHasPlage);
        }

        return $this;
    }
    public function __toString()
    {
        // TODO: Implement toString() method.
        return $this->nom;
    }
}
