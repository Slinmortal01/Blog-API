<?php

namespace ShortenUrl\Controller;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Laminas\Diactoros\Response\JsonResponse;
use Ramsey\Uuid\Uuid;
use ShortenUrl\Repository\PostsRepository;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class PostByIdController
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
        $post = $this->postsRepository->postById(Uuid::fromString($args['id']));
        return new JsonResponse(PostResponse::postResponse($post));
    }

}