<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
class Vehicle implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $plate = null;

    #[ORM\Column(length: 255)]
    private ?string $observedDamages = null;

    #[ORM\Column]
    private ?int $kilometers = null;

    #[ORM\Column]
    private ?float $buyPrice = null;

    #[ORM\Column]
    private ?float $sellPrice = null;

    #[ORM\Column(length: 255)]
    private ?string $fuel = null;

    #[ORM\Column]
    private ?float $iva = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $chassisNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $gearShit = null;

    #[ORM\Column]
    private ?bool $isNew = null;

    #[ORM\Column]
    private ?bool $transportIncluded = null;

    #[ORM\Column(length: 255)]
    private ?string $color = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $registrationDate = null;

    #[ORM\OneToMany(mappedBy: 'vehicle', targetEntity: Image::class, orphanRemoval: true)]
    private Collection $images;

    #[ORM\OneToMany(mappedBy: 'vehicle', targetEntity: Document::class, orphanRemoval: true)]
    private Collection $documents;

    #[ORM\ManyToOne(cascade: ['persist'], inversedBy: 'vehicles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Model $model = null;

    #[ORM\ManyToOne(inversedBy: 'vehicles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Provider $provider = null;

    #[ORM\ManyToOne(inversedBy: 'vehicles')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Order $vehicleOrder = null;


    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->documents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlate(): ?string
    {
        return $this->plate;
    }

    public function setPlate(string $plate): static
    {
        $this->plate = $plate;

        return $this;
    }

    public function getObservedDamages(): ?string
    {
        return $this->observedDamages;
    }

    public function setObservedDamages(string $observedDamages): static
    {
        $this->observedDamages = $observedDamages;

        return $this;
    }

    public function getKilometers(): ?int
    {
        return $this->kilometers;
    }

    public function setKilometers(int $kilometers): static
    {
        $this->kilometers = $kilometers;

        return $this;
    }

    public function getBuyPrice(): ?float
    {
        return $this->buyPrice;
    }

    public function setBuyPrice(float $buyPrice): static
    {
        $this->buyPrice = $buyPrice;

        return $this;
    }

    public function getSellPrice(): ?float
    {
        return $this->sellPrice;
    }

    public function setSellPrice(float $sellPrice): static
    {
        $this->sellPrice = $sellPrice;

        return $this;
    }

    public function getFuel(): ?string
    {
        return $this->fuel;
    }

    public function setFuel(string $fuel): static
    {
        $this->fuel = $fuel;

        return $this;
    }

    public function getIva(): ?float
    {
        return $this->iva;
    }

    public function setIva(float $iva): static
    {
        $this->iva = $iva;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getChassisNumber(): ?string
    {
        return $this->chassisNumber;
    }

    public function setChassisNumber(string $chassisNumber): static
    {
        $this->chassisNumber = $chassisNumber;

        return $this;
    }

    public function getGearShit(): ?string
    {
        return $this->gearShit;
    }

    public function setGearShit(string $gearShit): static
    {
        $this->gearShit = $gearShit;

        return $this;
    }

    public function isIsNew(): ?bool
    {
        return $this->isNew;
    }

    public function setIsNew(bool $isNew): static
    {
        $this->isNew = $isNew;

        return $this;
    }

    public function isTransportIncluded(): ?bool
    {
        return $this->transportIncluded;
    }

    public function setTransportIncluded(bool $transportIncluded): static
    {
        $this->transportIncluded = $transportIncluded;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getRegistrationDate(): ?\DateTimeInterface
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(\DateTimeInterface $registrationDate): static
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setVehicle($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getVehicle() === $this) {
                $image->setVehicle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Document>
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): static
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);
            $document->setVehicle($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): static
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getVehicle() === $this) {
                $document->setVehicle(null);
            }
        }

        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(Model $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getProvider(): ?Provider
    {
        return $this->provider;
    }

    public function setProvider(?Provider $provider): static
    {
        $this->provider = $provider;

        return $this;
    }

    public function getVehicleOrder(): ?Order
    {
        return $this->vehicleOrder;
    }

    public function setVehicleOrder(?Order $vehicleOrder): static
    {
        $this->vehicleOrder = $vehicleOrder;

        return $this;
    }

    function jsonSerialize(): array
    {
        return ['id' => $this->id,
            'plate' => $this->plate,
            'observedDamages' => $this->observedDamages,
            'kilometers' => $this->kilometers,
            'buyPrice' => $this->buyPrice,
            'sellPrice' => $this->sellPrice,
            'fuel' => $this->fuel,
            'iva' => $this->iva,
            'description' => $this->description,
            'chassisNumber' => $this->chassisNumber,
            'gearShit' => $this->gearShit,
            'isNew' => $this->isNew,
            'transportIncluded' => $this->transportIncluded,
            'color' => $this->color,
            'registrationDate' => $this->registrationDate
        ];
    }

}
