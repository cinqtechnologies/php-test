<?php

declare(strict_types=1);

namespace Ecommerce\Repositories;

use Ecommerce\Repositories\Contracts\ValidatorAccessInterface;
use Ecommerce\Repositories\Contracts\RetailerEntityInterface;
use Ecommerce\Repositories\Contracts\RetailerValidatorInterface;

/**
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
class RetailerEntity implements RetailerEntityInterface, ValidatorAccessInterface
{
    private $id;
    private $name;
    private $logo;
    private $description;
    private $website;
    private $validator;

    public function __construct(RetailerValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function setId(int $id): RetailerEntity
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): int
    {
        return (int) $this->id;
    }

    public function setName(string $name): RetailerEntity
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return (string) $this->name;
    }

    public function setLogo(string $logo): RetailerEntity
    {
        $this->logo = $logo;
        return $this;
    }

    public function getLogo(): string
    {
        return (string) $this->logo;
    }

    public function setDescription(string $description): RetailerEntity
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription(): string
    {
        return (string) $this->description;
    }

    public function setWebsite(string $website): RetailerEntity
    {
        $this->website = $website;
        return $this;
    }

    public function getWebsite(): string
    {
        return (string) $this->website;
    }

    public function isValid(): bool
    {
        return $this->validator->isValid($this);
    }

    public function getValidationMessages(): array
    {
        return $this->validator->getMessages();
    }

    public function isUpdateAction(): bool
    {
        return $this->id > 0;
    }
}
