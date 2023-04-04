<?php

namespace ShortenUrl\Controller;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Laminas\Diactoros\Response\JsonResponse;
use ShortenUrl\Repository\PostsRepository;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class PostGetAllController
{
    private PostsRepository $postsRepository;

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function __construct(Container $container)
    {
        $this->postsRepository = $container->get('post-repository');
    }
    public function __invoke(Request $request, Response $response, $args): JsonResponse
    {
        $posts = $this->postsRepository->allPosts();
        return $this->toJson($posts);
    }
    private function toJson(array $posts): JsonResponse
    {
        $response = [];
        foreach ($posts as $post) {
            $response[] = [
                'id' => $post->id()->toString(),
                'title' => $post->title(),
                'slug' => $post->slug(),
                'content' => $post->content(),
                'thumbnail' => $post->thumbnail(),
                'author' => $post->author(),
                'posted_at' => $post->posted_at(),
            ];
        }
        return new JsonResponse($response);
    }

}