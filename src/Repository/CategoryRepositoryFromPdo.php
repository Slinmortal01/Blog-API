<?php

namespace ShortenUrl\Repository;

use Ramsey\Uuid\UuidInterface;
use ShortenUrl\Entity\Category;

class CategoryRepositoryFromPdo implements CategoryRepository
{
    public function __construct(private \PDO $pdo)
    {
    }
    public function storeCategory(Category $category): void
    {
        $stm = $this->pdo->prepare('Insert Into categories VALUES (?,?,?)' );
        $stm->execute([
            $category->id()->toString(),
            $category->name(),
            $category->description(),
        ]);
    }
    public function allCategories(): array
    {
        $result = $this->pdo->query(<<<SQL
            SELECT * FROM categories
        SQL)->fetchAll();

        $categories = [];
        foreach ($result as $AllPost) {
            $categories[] = Category::populateCategory($AllPost);
        }
        return $categories;
    }
    public function categoryUpdate(UuidInterface $category_id, array $data): void
    {
        $stmt = $this->pdo->prepare(<<<SQL
            UPDATE categories
            SET name = :name, description = :description
            WHERE id = :id
        SQL);

        $stmt->bindValue(':id', $category_id);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':description', $data['description']);


        $stmt->execute();
    }
    public function categoryDelete(UuidInterface $category_id): string
    {
        $stmt = $this->pdo->prepare(<<<SQL
            DELETE 
            FROM categories
            WHERE id = :id
        SQL);

        $stmt->bindParam(':id', $category_id);
        $stmt->execute();

        return $category_id;
    }
}