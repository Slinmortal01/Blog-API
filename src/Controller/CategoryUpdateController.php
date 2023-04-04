<?php

namespace ShortenUrl\Controller;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Laminas\Diactoros\Response\JsonResponse;
use Ramsey\Uuid\Uuid;
use ShortenUrl\Repository\CategoryRepository;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class CategoryUpdateController
{
    private CategoryRepository $categoryRepository;

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function __construct(Container $container)
    {
        $this->categoryRepository = $container->get('category-repository');
    }
    public function __invoke(Request $request, Response $response, $args): JsonResponse
    {
        $inputs = json_decode($request->getBody()->getContents(), true);
        foreach ($inputs as $input) {
            $data = [
                'name' => $input['name'],
                'description' => $input['description'],
            ];

            $this->categoryRepository->categoryUpdate(Uuid::fromString($args['id']), $data);
        }
        $output = [
            'status' => 'success',

        ];

        return new JsonResponse($output);
    }
}