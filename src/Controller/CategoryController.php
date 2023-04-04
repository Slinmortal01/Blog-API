<?php

namespace ShortenUrl\Controller;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Laminas\Diactoros\Response\JsonResponse;
use Ramsey\Uuid\Uuid;
use ShortenUrl\Entity\Category;
use ShortenUrl\Repository\CategoryRepository;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class CategoryController
{
    private CategoryRepository $CategoryRepository;
    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function __construct(Container $container)
    {
        $this->CategoryRepository = $container->get('category-repository');
    }
    public function __invoke(Request $request, Response $response, $args): JsonResponse
    {
        $inputs = json_decode($request->getBody()->getContents(), true, JSON_THROW_ON_ERROR);
        foreach ($inputs as $input) {
            $Category = new Category(Uuid::uuid4(), $input['name'], $input['description']);
            $this->CategoryRepository->storeCategory($Category);

            $output = [
                'name' => $Category->name(),
                'description' => $Category->description(),
            ];
        }
        return new JsonResponse($output);

    }
}