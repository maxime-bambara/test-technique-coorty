<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 */
class Ville
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $codePostal;

    /**
     * @ORM\OneToMany(targetEntity=Habitant::class, mappedBy="ville", orphanRemoval=true)
     */
    private $habitants;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="villes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pays;

    public function __construct()
    {
        $this->habitants = new ArrayCollection();
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

    public function getCodePostal(): ?int
    {
        return $this->code_postal;
    }

    public function setCodePostal(int $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * @return Collection|Habitant[]
     */
    public function getHabitants(): Collection
    {
        return $this->habitants;
    }

    public function addHabitant(Habitant $habitant): self
    {
        if (!$this->habitants->contains($habitant)) {
            $this->habitants[] = $habitant;
            $habitant->setVille($this);
        }

        return $this;
    }

    public function removeHabitant(Habitant $habitant): self
    {
        if ($this->habitants->removeElement($habitant)) {
            // set the owning side to null (unless already changed)
            if ($habitant->getVille() === $this) {
                $habitant->setVille(null);
            }
        }

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }
}
