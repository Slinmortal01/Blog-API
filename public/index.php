<?php

use ShortenUrl\Controller\CategoriesGetAllController;
use ShortenUrl\Controller\CategoryController;
use ShortenUrl\Controller\CategoryDeleteController;
use ShortenUrl\Controller\CategoryUpdateController;
use ShortenUrl\Controller\HomeController;
use ShortenUrl\Controller\PostByIdController;
use ShortenUrl\Controller\PostBySlugController;
use ShortenUrl\Controller\PostController;
use ShortenUrl\Controller\PostDeleteController;
use ShortenUrl\Controller\PostGetAllController;
use ShortenUrl\Controller\PostUpdateController;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$container = require __DIR__ . '/../config/Container.php';

AppFactory::setContainer($container);
$app = AppFactory::create();

$app->get('/', HomeController::class);
$app->post('/v1/post/create', new PostController($container));
$app->get('/v1/posts/all', new PostGetAllController($container));
$app->get('/v1/posts/slug/{slug}', new PostBySlugController($container));
$app->get('/v1/posts/id/{id}', new PostByIdController($container));
$app->put('/v1/posts/update/{id}', new PostUpdateController($container));
$app->delete('/v1/posts/{id}', new PostDeleteController($container));
$app->post('/v1/category/create', new CategoryController($container));
$app->get('/v1/category/all', new CategoriesGetAllController($container));
$app->put('/v1/category/update/{id}', new CategoryUpdateController($container));
$app->delete('/v1/category/{id}', new CategoryDeleteController($container));


$app->addErrorMiddleware(true, true, true);
$app->run();
