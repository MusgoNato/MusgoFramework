<?php

namespace App\Chore;
use InvalidArgumentException;


enum Methods: string
{
    case GET = 'GET';
    case POST = 'POST';
    case PUT = 'PUT';
    case DELETE = 'DELETE';
}

/**
 * Summary of Route
 * Classe responsavel pelo registro de rotas
 */
class Route
{
    protected static array $routes = [];

    /**
     * Summary of get
     * @param string $uri
     * @param string|array $handler
     * @return void
     */
    public static function get(string $uri, string|array $handler): void
    {
        self::make($uri, $handler, Methods::GET);
    }


    /**
     * Summary of post
     * @return void
     */
    public static function post(string $uri, string|array $handler): void
    {
        self::make($uri, $handler, Methods::POST);
    }

    /**
     * Summary of put
     * @return void
     */
    public static function put(string $uri, string|array $handler): void
    {
        self::make($uri, $handler, Methods::PUT);
    }

    /**
     * Summary of delete
     * @return void
     */
    public static function delete(string $uri, string|array $handler): void
    {
        self::make($uri, $handler, Methods::DELETE);
    }


    /**
     * Summary of resource
     * @return void
     */
    public static function resource(string $index_uri, string $handler): void
    {
        // Pagina principal
        self::get("$index_uri", [$handler, 'index']);

        // Criar 1 registro
        self::post("$index_uri", [$handler, 'store']);

        // Mostrar 1 registro
        self::get("$index_uri/{id}", [$handler, 'show']);

        // Editar 1 registro
        self::get("$index_uri/{id}/edit", [$handler, 'edit']);

        // Atualizar 1 registro
        self::put("$index_uri/{id}", [$handler, 'update']);

        // Deletar 1 registro
        self::delete("$index_uri/{id}", [$handler, 'destroy']);                    
    }


    /**
     * Summary of compileURI
     * @return string
     */
    private static function compileURI(string $uri): string
    {
        return '#^' . preg_replace('#\{[^/]+\}#', '([^/]+)', $uri) . '$#';
    }


    /**
     * Summary of make
     * @param string $uri
     * @param string|array $handler
     * @param Methods $request_type
     * @throws InvalidArgumentException
     * @return void
     */
    private static function make(string $uri, string|array $handler, Methods $request_type): void
    {
        // Caso seja uma string, foi passado um classe ao segundo argumento com o metodo __invoke()
        if(is_string($handler))
        {
            $class = $handler;
            $method = '__invoke';
        }
        elseif(is_array($handler))
        {
            [$class, $method] = $handler;
        }
        else
        {
            throw new InvalidArgumentException("Handler invalido!");   
        }

        if(!class_exists($class))
        {
            throw new InvalidArgumentException("Classe não existe!");
        }

        // Registrando rotas
        self::$routes[] = [
            'http_method' => $request_type,
            'uri' => $uri,
            'regex' => self::compileURI($uri),
            'class' => $class,
            'method' => $method,
        ];
    }

    /**
     * Summary of routes
     * @return array
     */
    public static function routes(): array
    {
        return self::$routes;
    }
}