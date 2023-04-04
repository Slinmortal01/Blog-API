<?php

namespace ShortenUrl\Entity;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Category
{
    public function __construct(
        private UuidInterface $id,
        private string $name,
        private string $description,
    ){}

    public static function populateCategory(array $data): self
    {
        return new self(
            Uuid::fromString($data['id']),
            $data['name'],
            $data['description'],
        );}
    public function id(): UuidInterface
    {
        return $this->id;
    }
    public function name(): string
    {
        return $this->name;
    }
    public function description(): string
    {
        return $this->description;
    }


}