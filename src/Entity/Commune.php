<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommuneRepository")
 */
class Commune
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Departement", inversedBy="Comunes")
     */
    private $departement;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Plage", mappedBy="commune")
     */
    private $Plages;

    public function __construct()
    {
        $this->Plages = new ArrayCollection();
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

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * @return Collection|Plage[]
     */
    public function getPlages(): Collection
    {
        return $this->Plages;
    }

    public function addPlage(Plage $plage): self
    {
        if (!$this->Plages->contains($plage)) {
            $this->Plages[] = $plage;
            $plage->setCommune($this);
        }

        return $this;
    }

    public function removePlage(Plage $plage): self
    {
        if ($this->Plages->contains($plage)) {
            $this->Plages->removeElement($plage);
            // set the owning side to null (unless already changed)
            if ($plage->getCommune() === $this) {
                $plage->setCommune(null);
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
