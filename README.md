# php4-jagaad-project

A simple blog Post using OOP, Framework and some concepts of the PHP

## Description

A simple API for a blog. 

You can:

-Create, Read, Update and Delete Posts

-Create, Read, Update and Delete Categories

## Routes

###  Post Routes:

[POST] /v1/PostController (Create Post)

[GET] /v1/posts/all (Find All Posts)

[GET] /v1/posts/slug/{slug} (Find Post By Slog)

[GET] /v1/posts/id/{id} (Find Post By ID)

[PUT] /v1/posts/update/{id} (Update Post)

[DELETE] /v1/posts/{id} (Delete Post)

###  Categories Routes:

[POST] /v1/CategoryController (Create Category)

[GET] /v1/category/all (Find All Categories)

[PUT] /v1/category/update/{id} (Update Category)

[DELETE] /v1/category/{id} (Delete Category));


## Installation

Clone repository: git clone git@gitlab.com:LuisFernando002/php4-jagaad-project.git

Create the DB: php cli/create-db.php

Install the composer dependencies: composer install

Run the application in your localhost: php -S localhost:8000 -t public


## Frameworks and Packages 

Slim Framework: composer require slim/slim:"4.*",

composer require slim/psr7,

composer require nyholm/psr7 nyholm/psr7-server,

composer require guzzlehttp/psr7 "^2",

composer require laminas/laminas-diactoros,

Ramsey Uuid: composer require ramsey/uuid

Swagger: composer require zircote/swagger-php

Slugify: composer require cocur/slugify

PHP Stan: composer require --dev phpstan/phpstan

PHP Code Sniffer: composer require squizlabs/php_codesniffer


## Authors 
 Luis Fernando - Junior PHP Developer

## Project status
In progress... 
