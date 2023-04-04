<?php
namespace ShortenUrl\Controller;
use DI\Container;
use Laminas\Diactoros\Response\JsonResponse;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

readonly class HomeController
{
    public function __construct(private Container $container){}
    public function __invoke(Request $request, Response $response, $args): JsonResponse
    {
        $data = ['test' => $this->container->get('myService')];
        return new JsonResponse($data);
    }
}



  




