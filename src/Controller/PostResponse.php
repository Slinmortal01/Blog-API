<?php

namespace ShortenUrl\Controller;

use ShortenUrl\Entity\Post;

class PostResponse
{
    public function __construct(

        public string $title,
        public string $slug,
        public string $content,
        public string $thumbnail,
        public string $author,
        public string $posted_at,
    ) {
    }
    public static function postResponse(Post $posts): self
    {
        return new PostResponse(
            $posts->title(),
            $posts->slug(),
            $posts->content(),
            $posts->thumbnail(),
            $posts->author(),
            $posts->posted_at()
        );
    }

}