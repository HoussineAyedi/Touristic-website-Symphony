<?php

namespace App\Entity;

use App\Repository\CircuitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CircuitRepository::class)
 */
class Circuit
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
    private $code_circuit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $des_circuit;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree;

    /**
     * @ORM\OneToMany(targetEntity=EtapeCr::class, mappedBy="circuit")
     */
    private $circuitEt;

    public function __construct()
    {
        $this->circuitEt = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeCircuit(): ?string
    {
        return $this->code_circuit;
    }

    public function setCodeCircuit(string $code_circuit): self
    {
        $this->code_circuit = $code_circuit;

        return $this;
    }

    public function getDesCircuit(): ?string
    {
        return $this->des_circuit;
    }

    public function setDesCircuit(string $des_circuit): self
    {
        $this->des_circuit = $des_circuit;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * @return Collection|EtapeCr[]
     */
    public function getCircuitEt(): Collection
    {
        return $this->circuitEt;
    }

    public function addCircuitEt(EtapeCr $circuitEt): self
    {
        if (!$this->circuitEt->contains($circuitEt)) {
            $this->circuitEt[] = $circuitEt;
            $circuitEt->setCircuit($this);
        }

        return $this;
    }

    public function removeCircuitEt(EtapeCr $circuitEt): self
    {
        if ($this->circuitEt->contains($circuitEt)) {
            $this->circuitEt->removeElement($circuitEt);
            // set the owning side to null (unless already changed)
            if ($circuitEt->getCircuit() === $this) {
                $circuitEt->setCircuit(null);
            }
        }

        return $this;
    }
}
