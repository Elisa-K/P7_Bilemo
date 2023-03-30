<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;
use ApiPlatform\Metadata\GetCollection;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\Table("products")]
#[GetCollection(paginationItemsPerPage: 3)]
#[Get]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    /**
     * Nom du modèle
     */
    #[ORM\Column(length: 255)]
    private string $name;

    /**
     * Marque
     */
    #[ORM\Column(length: 255)]
    private string $brand;

    /**
     * Prix
     */
    #[ORM\Column(length: 255)]
    private string $price;

    /**
     * Taille de l'écran en pouce
     */
    #[ORM\Column(length: 255)]
    private string $size;

    /**
     * Capacité de stockage
     */
    #[ORM\Column(length: 255)]
    private string $storage;

    /**
     * Date de sortie
     */
    #[ORM\Column]
    private \DateTimeImmutable $releaseDate;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getSize(): string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getStorage(): string
    {
        return $this->storage;
    }

    public function setStorage(string $storage): self
    {
        $this->storage = $storage;

        return $this;
    }

    public function getReleaseDate(): \DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }
}