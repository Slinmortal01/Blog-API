<?php

namespace ShortenUrl\Controller;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Laminas\Diactoros\Response\JsonResponse;
use PDOException;
use Ramsey\Uuid\Uuid;
use ShortenUrl\Repository\PostsRepository;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class PostDeleteController
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
        try {
            $this->postsRepository->postDelete(Uuid::fromString($args['id']));

            $output = [
                'status' => 'success'
            ];

            return new JsonResponse($output);
        } catch (PDOException $e) {
            error_log($e);
            $output = [
                'status' => 'error',
                'message' => "Something it's wrong, please, try again later",
            ];

            return new JsonResponse($output, 500);
        }
    }

}