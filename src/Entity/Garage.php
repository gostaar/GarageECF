<?php

namespace App\Entity;

use App\Repository\GarageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GarageRepository::class)]
class Garage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $tel = null;

    #[ORM\ManyToMany(targetEntity: Horaires::class, inversedBy: 'garages')]
    private Collection $horaires;

    #[ORM\ManyToMany(targetEntity: Services::class, inversedBy: 'garages')]
    private Collection $Services;

    public function __construct()
    {
        $this->horaires = new ArrayCollection();
        $this->Services = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * @return Collection<int, Horaires>
     */
    public function getHoraires(): Collection
    {
        return $this->horaires;
    }

    public function addHoraire(Horaires $horaire): static
    {
        if (!$this->horaires->contains($horaire)) {
            $this->horaires->add($horaire);
        }

        return $this;
    }

    public function removeHoraire(Horaires $horaire): static
    {
        $this->horaires->removeElement($horaire);

        return $this;
    }

    /**
     * @return Collection<int, Services>
     */
    public function getServices(): Collection
    {
        return $this->Services;
    }

    public function addService(Services $service): static
    {
        if (!$this->Services->contains($service)) {
            $this->Services->add($service);
        }

        return $this;
    }

    public function removeService(Services $service): static
    {
        $this->Services->removeElement($service);

        return $this;
    }
}
