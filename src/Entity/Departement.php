<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DepartementRepository")
 */
class Departement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commune", mappedBy="departement")
     */
    private $Comunes;

    public function __construct()
    {
        $this->Comunes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Commune[]
     */
    public function getComunes(): Collection
    {
        return $this->Comunes;
    }

    public function addComune(Commune $comune): self
    {
        if (!$this->Comunes->contains($comune)) {
            $this->Comunes[] = $comune;
            $comune->setDepartement($this);
        }

        return $this;
    }

    public function removeComune(Commune $comune): self
    {
        if ($this->Comunes->contains($comune)) {
            $this->Comunes->removeElement($comune);
            // set the owning side to null (unless already changed)
            if ($comune->getDepartement() === $this) {
                $comune->setDepartement(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        // TODO: Implement toString() method.
        return $this->nom;
    }
}
