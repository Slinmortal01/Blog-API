<?php

namespace ShortenUrl\Entity;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Post
{
    public function __construct(
        private UuidInterface $id,
        private string $title,
        private string $slug,
        private string $content,
        private string $thumbnail,
        private string $author,
        private string $posted_at,
    ){}

    public static function populate(array $data): self
    {
    return new self(
        Uuid::fromString($data['id']),
        $data['title'],
        $data['slug'],
        $data['content'],
        $data['author'],
        $data['thumbnail'],
        $data['posted_at'],

);}
        public function id(): UuidInterface
        {
            return $this->id;
        }
        public function title(): string
        {
            return $this->title;
        }
        public function slug(): string
        {
            return $this->slug;
        }
        public function content(): string
        {
            return $this->content;
        }
        public function thumbnail(): string
        {
            return $this->thumbnail;
        }
        public function author(): string
        {
            return $this->author;
        }
        public function posted_at(): string
        {
            return $this->posted_at;
        }


}