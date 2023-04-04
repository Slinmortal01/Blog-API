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

class PostUpdateController
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
        $inputs = json_decode($request->getBody()->getContents(), true);
        foreach ($inputs as $input) {
            $data = [
                'title' => $input['title'],
                'slug' => $input['slug'],
                'content' => $input['content'],
                'thumbnail' => $input['thumbnail'],
                'author' => $input['author'],
                'posted_at' => $input['posted_at']
            ];

            $this->postsRepository->postUpdate(Uuid::fromString($args['id']), $data);
        }
        $output = [
            'status' => 'success',

        ];

        return new JsonResponse($output);
    }

}