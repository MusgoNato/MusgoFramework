<?php 

use App\Chore\Methods;
use App\Chore\Route;

define('BASE_PATH', dirname(__DIR__));
define('VIEW_BASE_PATH', dirname(__DIR__, 1) . '\\resources\\views\\');

require '../bootstrap/app.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$method = Methods::from($_SERVER['REQUEST_METHOD']);

$routes = Route::routes();
$matchedRoute = null;
$params = [];


foreach($routes as $route)
{   
    if($route['http_method'] !== $method)
    {
        continue;
    }

    if(preg_match($route['regex'], $uri, $matches))
    {
        array_shift($matches);
        $matchedRoute = $route;
        $params = $matches;
        break;   
    }
}

if(!$matchedRoute)
{
    http_response_code(404);
    exit('404');
}

$controller = new $matchedRoute['class'];
$response = call_user_func_array([$controller, $matchedRoute['method']], $params);

echo $response;
