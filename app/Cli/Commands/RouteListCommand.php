<?php 

namespace App\Cli\Commands;

use App\Cli\Commands\Command;
use App\Chore\Route;
use App\Helpers\TerminalColors;

enum EnumFlagsRouteCommand: string
{
    case DEFAULT = '';
    case ALL_REGEX_ROUTES = '-r';
    case ALL_CONTROLLERS  = '-c';
    case ALL_URIS = '-u';
}

class RouteListCommand extends Command
{
    public function handle(array $args): void
    {
        $flag = EnumFlagsRouteCommand::tryFrom($args[0] ?? '');

        switch($flag)
        {
            case EnumFlagsRouteCommand::DEFAULT:
                self::cliFlagRouteCommandDefault();
                break;
            case EnumFlagsRouteCommand::ALL_REGEX_ROUTES:
                self::cliFlagRouteCommandOnlyRegex();
                break;
            case EnumFlagsRouteCommand::ALL_CONTROLLERS:
                self::cliFlagRouteCommandOnlyControllers();
                break;
            case EnumFlagsRouteCommand::ALL_URIS:
                self::cliFlagRouteCommandOnlyURIs();
                break;
            default:
                self::help();
        }
    }


    /**
     * Summary of cliFlagRouteCommandDefault
     * @return void
     */
    private static function cliFlagRouteCommandDefault()
    {
        //
        
        $routes = Route::routes();

        echo TerminalColors::TEXT['green'] . str_pad('METHOD', 8)
        . TerminalColors::TEXT['yellow'] . str_pad('URI', 30)
        . TerminalColors::TEXT['blue'] . "CONTROLLER\n";

        echo TerminalColors::TEXT['black'] . str_repeat('-', 60) . PHP_EOL;

        foreach ($routes as $route) 
        {
            echo TerminalColors::TEXT['green'] .str_pad($route['http_method']->value, 8)
            . TerminalColors::TEXT['yellow'] . str_pad($route['uri'], 30)
            . TerminalColors::TEXT['blue'] . "{$route['class']}@{$route['method']}\n";
        }

        echo "\e[0m";


    }

    public static function help(): void
    {
        
        echo TerminalColors::TEXT['yellow'] 
        . "Flags disponíveis:\n" 
        . TerminalColors::TEXT['green']
        . "\t-r\t" . TerminalColors::TEXT['white'] . "=>\t" . TerminalColors::TEXT['cyan'] . "Lista o regex de todas as rotas\n"
        . TerminalColors::TEXT['green']
        . "\t-c\t" . TerminalColors::TEXT['white'] . "=>\t" . TerminalColors::TEXT['cyan'] . "Lista todos controllers registrados e seus respectivos metodos\n"
        . TerminalColors::TEXT['green']
        . "\t-u\t" . TerminalColors::TEXT['white'] . "=>\t" . TerminalColors::TEXT['cyan'] . "Lista todas as URIs registradas\n"
        .
        TerminalColors::RESET;
    }


    private static function cliFlagRouteCommandOnlyRegex(): void
    {

        $routes = Route::routes();

        echo TerminalColors::TEXT['green'] . str_pad('METHOD', 8)
        . TerminalColors::TEXT['red'] . str_pad('REGEX', 30) . "\n";

        echo TerminalColors::TEXT['black'] . str_repeat('-', 60) . PHP_EOL;

        foreach ($routes as $route) 
        {
            echo TerminalColors::TEXT['green'] . str_pad($route['http_method']->value, 8)
            . TerminalColors::TEXT['red'] . str_pad($route['regex'], 30) . "\n";
        }

        echo TerminalColors::RESET;
    }

    /**
     * Summary of cliFlagRouteCommandOnlyControllers
     * @return void
     */
    private static function cliFlagRouteCommandOnlyControllers(): void
    {
        $routes = Route::routes();

        echo TerminalColors::TEXT['blue'] . "CONTROLLER\n";

        echo TerminalColors::TEXT['black'] . str_repeat('-', 60) . PHP_EOL;

        foreach ($routes as $route) 
        {
            echo TerminalColors::TEXT['green']
            . TerminalColors::TEXT['blue'] . "{$route['class']}@{$route['method']}\n";
        }

        echo TerminalColors::RESET;

    } 

    private static function cliFlagRouteCommandOnlyURIs(): void
    {
        $routes = Route::routes();

        echo TerminalColors::TEXT['yellow'] . str_pad('URI', 30) . "\n";

        echo TerminalColors::TEXT['black'] . str_repeat('-', 60) . PHP_EOL;

        foreach ($routes as $route) 
        {
            echo TerminalColors::TEXT['yellow'] . str_pad($route['uri'], 8) . "\n";
        }

        echo TerminalColors::RESET;

    } 
}

?>