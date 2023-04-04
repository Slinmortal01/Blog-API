<?php

namespace ShortenUrl\Controller;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Laminas\Diactoros\Response\JsonResponse;
use ShortenUrl\Repository\CategoryRepository;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class CategoriesGetAllController
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
        $categories = $this->categoryRepository->allCategories();
        return $this->toJson($categories);
    }
    private function toJson(array $categories): JsonResponse
    {
        $response = [];
        foreach ($categories as $category) {
            $response[] = [
                'id' => $category->id()->toString(),
                'name' => $category->name(),
                'description' => $category->description(),
            ];
        }
        return new JsonResponse($response);
    }
}