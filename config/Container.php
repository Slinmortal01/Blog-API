<?php
use DI\Container;
use ShortenUrl\Repository\CategoryRepositoryFromPdo;
use ShortenUrl\Repository\PostCategoryRepositoryFromPdo;
use ShortenUrl\Repository\PostsRepositoryFromPdo;

$container = new Container();
$container->set('settings', static function(){
    return [
'db' => [
            'host' => 'localhost',
            'dbname' => 'Blog',
            'user' => 'root',
            'pass' => ''
        ]
    ];
});
$container->set('db', static function ($c) {
    $db = $c->get('settings')['db'];
    $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'], $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
});
$container->set('post-repository', static function(Container $c){
    $pdo = $c->get('db');
    return new PostsRepositoryFromPdo($pdo);
});
$container->set('category-repository', static function(Container $c){
    $pdo = $c->get('db');
    return new CategoryRepositoryFromPdo($pdo);
});
/*$container->set('post-category-repository', static function(Container $c){
    $pdo = $c->get('db');
    return new PostCategoryRepositoryFromPdo($pdo);
});*/
return $container;
