<?php
declare(strict_types=1);

namespace App\Models;

class Product
{
    private $name;
    private $price;
    private $description;
    private $retailerId;
    private $id;
    private $image;

    public function __construct(string $name, float $price, string $description, int $retailerId = null, int $id = null, string $image = null)
    {
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->retailerId = $retailerId ?? 1;
        $this->id = $id;
        $this->image = $image ?? '';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getRetailerId(): int
    {
        return $this->retailerId;
    }

    /**
     * @param int $retailerId
     */
    public function setRetailerId(int $retailerId): void
    {
        $this->retailerId = $retailerId;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }


}