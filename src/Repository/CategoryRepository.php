<?php

namespace ShortenUrl\Repository;

use Ramsey\Uuid\UuidInterface;
use ShortenUrl\Entity\Category;

interface CategoryRepository
{
    public function storeCategory(Category $category): void;
    public function allCategories(): array;
    public function categoryUpdate(UuidInterface $category_id, array $data): void;
    public function categoryDelete(UuidInterface $category_id): string;
}