<?php

namespace ShortenUrl\Repository;

use Ramsey\Uuid\UuidInterface;
use ShortenUrl\Entity\Post;

class PostsRepositoryFromPdo implements PostsRepository
{
    public function __construct(private \PDO $pdo)
    {
    }
    public function storePost(Post $posts): void
    {
        $stm = $this->pdo->prepare('Insert Into posts VALUES (?,?,?,?,?,?,?)' );
        $stm->execute([
           $posts->id()->toString(),
           $posts->title(),
           $posts->slug(),
           $posts->content(),
           $posts->thumbnail(),
           $posts->author(),
           $posts->posted_at(),
        ]);
    }
    public function postBySlug($slug): array
    {
        $stmt = $this->pdo->prepare(<<<SQL
            SELECT * 
            FROM posts
            WHERE slug = ?
        SQL);

        $stmt->execute([$slug]);
        $data = [];
        foreach ($stmt as $item) {
            $data[] = Post::populate($item);
        }
        return $data;
    }
    public function allPosts(): array
    {
        $result = $this->pdo->query(<<<SQL
            SELECT * FROM posts
        SQL)->fetchAll();

        $posts = [];
        foreach ($result as $AllPost) {
            $posts[] = Post::populate($AllPost);
        }
        return $posts;
    }
    public function postById(UuidInterface $post_id): Post
    {
        $stmt = $this->pdo->prepare(<<<SQL
            SELECT * 
            FROM posts
            WHERE id = ?
        SQL);

        $stmt->execute([$post_id->toString()]);
        $data = $stmt->fetch();
        return Post::populate($data);
    }
    public function postUpdate(UuidInterface $post_id, array $data): void
    {
        $stmt = $this->pdo->prepare(<<<SQL
            UPDATE posts
            SET title = :title, slug = :slug, content = :content, thumbnail = :thumbnail, author = :author, posted_at = :posted_at
            WHERE id = :id
        SQL);

        $stmt->bindValue(':id', $post_id);
        $stmt->bindValue(':title', $data['title']);
        $stmt->bindValue(':slug', $data['slug']);
        $stmt->bindValue(':content', $data['content']);
        $stmt->bindValue(':thumbnail', $data['thumbnail']);
        $stmt->bindValue(':author', $data['author']);
        $stmt->bindValue(':posted_at', $data['posted_at']);

        $stmt->execute();
    }
    public function postDelete(UuidInterface $post_id): string
{
    $stmt = $this->pdo->prepare(<<<SQL
            DELETE 
            FROM posts
            WHERE id = :id
        SQL);

    $stmt->bindParam(':id', $post_id);
    $stmt->execute();

    return $post_id;
}


}