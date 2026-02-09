<?php 

use App\Chore\Methods;
use App\Chore\Route;

define('BASE_PATH', dirname(__DIR__));
define('VIEW_BASE_PATH', dirname(__DIR__, 1) . '\\resources\\views\\');

// Carrega o autoload e o arquivo de rotas no mesmo processo
require '../bootstrap/app.php';

/**
 * TUDO ABAIXO EH EM RELAÇÃO HTTP
 * 
 */

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Atribui a $method a string mapeada por Methods::from
$method = Methods::from($_SERVER['REQUEST_METHOD']);

// Pego as rotas colocadas em web.php
$routes = Route::routes();
$matchedRoute = null;
$params = [];


// Varre cada metodo
foreach($routes as $route)
{   
    // Verifica se o metodo eh o mesmo que o metodo atual da pagina
    if($route['http_method'] !== $method)
    {
        continue;
    }

    // Faz a verificação do regex, se o regex feito na uri casa com o regex feito la em Route
    if(preg_match($route['regex'], $uri, $matches))
    {
        array_shift($matches);
        $matchedRoute = $route;
        $params = $matches;
        break;   
    }
}

// Verifica se existem as rotas
if(!$matchedRoute)
{
    http_response_code(404);
    exit('404');
}


// Instancio o objeto e executo seu metodo passando os parametros que foram colocados via URI na requisição
$controller = new $matchedRoute['class'];
$response = call_user_func_array([$controller, $matchedRoute['method']], $params);

// Imprimo o metodo
echo $response;
