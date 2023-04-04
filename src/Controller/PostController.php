<?php

namespace ShortenUrl\Controller;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Laminas\Diactoros\Response\JsonResponse;
use Ramsey\Uuid\Uuid;
use ShortenUrl\Entity\Post;
use ShortenUrl\Repository\PostsRepository;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class PostController
{
    private PostsRepository $PostsRepository;

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function __construct(Container $container)
    {
       $this->PostsRepository = $container->get('post-repository');
    }
    public function __invoke(Request $request, Response $response, $args): JsonResponse
    {
        $inputs = json_decode($request->getBody()->getContents(), true, JSON_THROW_ON_ERROR);
        foreach ($inputs as $input) {
            $Post = new Post(Uuid::uuid4(), $input['title'], $input['slug'], $input['content'], $input['thumbnail'], $input['author'], $input['posted_at']);
            $this->PostsRepository->storePost($Post);

            $output = [
                'title' => $Post->title(),
                'slug' => $Post->slug(),
                'content' => $Post->content(),
                'thumbnail' => $Post->thumbnail(),
                'author' => $Post->author(),
                'posted_at' => $Post->posted_at(),
            ];
        }
        return new JsonResponse($output);

    }
}