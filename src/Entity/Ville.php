<?php

namespace App\Entity;
use Symfony\Component\HttpFoundation\File\File;
use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 * @Vich\Uploadable()
 */
class Ville
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
     * @Vich\UploadableField(mapping="ville_image", fileNameProperty="filename")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="integer")
     */



    /**
     * @ORM\Column(type="integer")
     */
    private $code_ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $des_ville;

    /**
     * @ORM\ManyToOne(targetEntity=Destination::class, inversedBy="dest_ref")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dest_test;

    /**
     * @ORM\OneToMany(targetEntity=EtapeCr::class, mappedBy="ville")
     */
    private $villecr;

    public function __construct()
    {
        $this->villecr = new ArrayCollection();
    }
//getId()  getCodeVille() getDesVille() getDestTest()
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeVille(): ?string
    {
        return $this->code_ville;
    }
 // code_ville
    // des_ville
    //dest_test

    public function setCodeVille(string $code_ville): self
    {
        $this->code_ville = $code_ville;

        return $this;
    }

    public function getDesVille(): ?string
    {
        return $this->des_ville;
    }

    public function setDesVille(string $des_ville): self
    {
        $this->des_ville = $des_ville;

        return $this;
    }

    public function getDestTest(): ?Destination
    {
        return $this->dest_test;
    }

    public function setDestTest(?Destination $dest_test): self
    {
        $this->dest_test = $dest_test;

        return $this;
    }

    /**
     * @return Collection|EtapeCr[]
     */
    public function getVillecr(): Collection
    {
        return $this->villecr;
    }

    public function addVillecr(EtapeCr $villecr): self
    {
        if (!$this->villecr->contains($villecr)) {
            $this->villecr[] = $villecr;
            $villecr->setVille($this);
        }

        return $this;
    }

    public function removeVillecr(EtapeCr $villecr): self
    {
        if ($this->villecr->contains($villecr)) {
            $this->villecr->removeElement($villecr);
            // set the owning side to null (unless already changed)
            if ($villecr->getVille() === $this) {
                $villecr->setVille(null);
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
     * @return Ville
     */
    public function setFilename(?string $filename): Ville
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
     * @return Ville
     */
    public function setImageFile(?File $imageFile): Ville
    {
        $this->imageFile = $imageFile;
        return $this;
    }






}
