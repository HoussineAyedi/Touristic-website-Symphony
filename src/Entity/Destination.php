<?php

namespace App\Entity;
use Symfony\Component\HttpFoundation\File\File;

use App\Repository\DestinationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * @ORM\Entity(repositoryClass=DestinationRepository::class)
 * @Vich\Uploadable()
 */
class Destination
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="destination_image", fileNameProperty="filename")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="integer")
     */

    private $code_dest;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dest_test;

    /**
     * @ORM\OneToMany(targetEntity=Ville::class, mappedBy="dest_test", orphanRemoval=true)
     */
    private $dest_ref;

    public function __construct()
    {
        $this->dest_ref = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeDest(): ?int
    {
        return $this->code_dest;
    }

    public function setCodeDest(int $code_dest): self
    {
        $this->code_dest = $code_dest;

        return $this;
    }

    public function getDestTest(): ?string
    {
        return $this->dest_test;
    }

    public function setDestTest(string $dest_test): self
    {
        $this->dest_test = $dest_test;

        return $this;
    }

    /**
     * @return Collection|Ville[]
     */
    public function getDestRef(): Collection
    {
        return $this->dest_ref;
    }

    public function addDestRef(Ville $destRef): self
    {
        if (!$this->dest_ref->contains($destRef)) {
            $this->dest_ref[] = $destRef;
            $destRef->setDestTest($this);
        }

        return $this;
    }

    public function removeDestRef(Ville $destRef): self
    {
        if ($this->dest_ref->contains($destRef)) {
            $this->dest_ref->removeElement($destRef);
            // set the owning side to null (unless already changed)
            if ($destRef->getDestTest() === $this) {
                $destRef->setDestTest(null);
            }
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string|null $filename
     * @return Destination
     */
    public function setFilename(?string $filename): Destination
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     * @return Destination
     */
    public function setImageFile(?File $imageFile): Destination
    {
        $this->imageFile = $imageFile;
        return $this;
    }












}
