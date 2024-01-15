<?php

namespace App\Entity;

use App\Repository\ProfessionalRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProfessionalRepository::class)]
class Professional extends Customer
{

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank]
    #[Assert\Type(type :'string')]
    #[Assert\Length(max: 20)]
    private ?string $cif = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank]
    #[Assert\Type(type :'string')]
    #[Assert\Length(max: 20)]
    private ?string $managerNif = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    #[Assert\File(
        maxSize: '10M',
        mimeTypes: '{"application/pdf", "application/x-pdf"}',
        maxSizeMessage: 'Per favor, puja un fitxer PDF vàlid.'
    )]
    private ?string $LOPDdoc = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Type(type :'string')]
    #[Assert\Length(max: 255)]
    private ?string $bussinessName = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    #[Assert\File(
        maxSize: '10M',
        mimeTypes: '{"application/pdf", "application/x-pdf"}',
        maxSizeMessage: 'Per favor, puja un fitxer PDF vàlid.'
    )]
    private ?string $constitutionWriting = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Type(type:'bool')]
    private ?bool $subscription = null;



    public function getCif(): ?string
    {
        return $this->cif;
    }

    public function setCif(string $cif): static
    {
        $this->cif = $cif;

        return $this;
    }

    public function getManagerNif(): ?string
    {
        return $this->managerNif;
    }

    public function setManagerNif(string $managerNif): static
    {
        $this->managerNif = $managerNif;

        return $this;
    }

    public function getLOPDdoc(): ?string
    {
        return $this->LOPDdoc;
    }

    public function setLOPDdoc(string $LOPDdoc): static
    {
        $this->LOPDdoc = $LOPDdoc;

        return $this;
    }

    public function getBussinessName(): ?string
    {
        return $this->bussinessName;
    }

    public function setBussinessName(string $bussinessName): static
    {
        $this->bussinessName = $bussinessName;

        return $this;
    }

    public function getConstitutionWriting(): ?string
    {
        return $this->constitutionWriting;
    }

    public function setConstitutionWriting(string $constitutionWriting): static
    {
        $this->constitutionWriting = $constitutionWriting;

        return $this;
    }

    public function isSubscription(): ?bool
    {
        return $this->subscription;
    }

    public function setSubscription(bool $subscription): static
    {
        $this->subscription = $subscription;

        return $this;
    }
}
