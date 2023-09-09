<?php 

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../storages/Database.php';

$dispatcher = FastRoute\cachedDispatcher(function(FastRoute\RouteCollector $r) {
    $domain = $_SERVER['HTTP_HOST'];
    if ($domain === 'common-api.necodeo.com' || $domain === 'common-api.localhost') {
        require_once __DIR__ . '/../domains/common-api/Links/Controller.php';
        require_once __DIR__ . '/../domains/common-api/routes.php';
    } elseif ($domain === 'images.necodeo.com' || $domain === 'images.localhost') {
        require_once __DIR__ . '/../domains/images/Controller.php';
        require_once __DIR__ . '/../domains/images/routes.php';
    } elseif ($domain === 'paper-api.necodeo.com' || $domain === 'paper-api.localhost') {
        require_once __DIR__ . '/../domains/paper-api/Posts/Repository.php';
        require_once __DIR__ . '/../domains/paper-api/Posts/Controller.php';
        require_once __DIR__ . '/../domains/paper-api/routes.php';
    }
}, [
    'cacheFile' => __DIR__ . '/../cache/route.cache',
    'cacheDisabled' => true,
]);

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        print '404 Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        print '405 Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$class, $method] = explode('@', $handler, 2);
        $class = new $class;
        $class->$method(...$vars);
        break;
}