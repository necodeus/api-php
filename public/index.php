<?php

require_once __DIR__ . '/../src/helpers.php';
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

Predis\Autoloader::register();

header("Access-Control-Allow-Origin: *");

ini_set('memory_limit', '4096M');
set_time_limit(10000);

$dispatcher = FastRoute\cachedDispatcher(function(FastRoute\RouteCollector $r) {
    $domain = $_SERVER['HTTP_HOST'];

    require_once __DIR__ . '/../src/rest/controllers/BaseController.php';

    if (preg_match('/^images\./', $domain)) {
        require_once __DIR__ . '/../src/rest/controllers/images/OutputController.php';
        require_once __DIR__ . '/../src/routers/images.php';
    }

    if (
        preg_match('/^paper-api\./', $domain)
        || preg_match('/^blog-api\./', $domain)
    ) {
        require_once __DIR__ . '/../src/rest/controllers/blog/PostController.php';
        require_once __DIR__ . '/../src/routers/blog-api.php';
    }

    if (preg_match('/^shop-api\./', $domain)) {
        require_once __DIR__ . '/../src/rest/controllers/shop/OrderController.php';
        require_once __DIR__ . '/../src/routers/shop-api.php';
    }

    if (preg_match('/^admin-api\./', $domain)) {
        require_once __DIR__ . '/../src/rest/controllers/admin/Schemas/IndexController.php';
        require_once __DIR__ . '/../src/routers/admin-api.php';
    }

    if (preg_match('/^finance-api\./', $domain)) {
        require_once __DIR__ . '/../src/routers/finance-api.php';
    }

    if (preg_match('/^weather-api\./', $domain)) {
        require_once __DIR__ . '/../src/rest/controllers/weather/WeatherController.php';
        require_once __DIR__ . '/../src/routers/weather-api.php';
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

try {
    switch ($routeInfo[0]) {
        case FastRoute\Dispatcher::NOT_FOUND: {
            print '404 Not Found';
            break;
        }
        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED: {
            $allowedMethods = $routeInfo[1];
            print '405 Method Not Allowed';
            break;
        }
        case FastRoute\Dispatcher::FOUND: {
            $handler = $routeInfo[1];
            $vars = $routeInfo[2];

            [$class, $method] = explode('@', $handler, 2);
            $class = new $class;
            print $class->$method(...$vars);
            break;
        }
        default: {
            
        }
    }
} catch (Exception $e) {
    print $e->getMessage();
}