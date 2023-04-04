<?php

namespace ShortenUrl\Repository;

use Ramsey\Uuid\UuidInterface;
use ShortenUrl\Entity\Post;

interface PostsRepository
{
    public function storePost(Post $posts): void;
    public function postBySlug($slug): array;
    public function allPosts(): array;
    public function postById(UuidInterface $post_id): Post;
    public function postUpdate(UuidInterface $post_id, array $data): void;
    public function postDelete(UuidInterface $post_id): string;


}