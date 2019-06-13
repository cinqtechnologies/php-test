<?php
declare(strict_types=1);

namespace App\Models;

class Retailer
{
    private $logo;
    private $website;
    private $description;
    private $id;

    /**
     * Retailer constructor.
     * @param string $logo
     * @param string $description
     * @param string $website
     */
    public function __construct(string $logo, string $description, string $website)
    {
        $this->logo = $logo;
        $this->website = $website;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getLogo(): string
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     */
    public function setLogo(string $logo): void
    {
        $this->logo = $logo;
    }

    /**
     * @return string
     */
    public function getWebsite(): string
    {
        return $this->website;
    }

    /**
     * @param string $website
     */
    public function setWebsite(string $website): void
    {
        $this->website = $website;
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
}