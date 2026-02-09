<?php 

namespace App\Chore\Cli;

use App\Chore\Cli\Command;
use App\Chore\Route;
use App\Helpers\TerminalColors;
use ErrorException;
use SplFileInfo;


enum EnumFlagsRouteCommand: string
{
    case DEFAULT = '';
    case ALL_INFO = '-all';
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
            case EnumFlagsRouteCommand::ALL_INFO:
                self::cliFlagRouteCommandAllInfo();
            default:
                self::help();
        }
    }


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
            echo "\033[0;32m" .str_pad($route['http_method']->value, 8)
            . TerminalColors::TEXT['yellow'] . str_pad($route['uri'], 30)
            . TerminalColors::TEXT['blue'] . "{$route['class']}@{$route['method']}\n";
        }

        echo "\e[0m";


    }

    public static function help(): void
    {
        
        echo "\e[33mFlags disponíveis:\e[032m 
        -all  \e[0m=> \033[1;36mLista todas as informações das rotas registradas a nível do sistema
        \e[0m";
    }


    private static function cliFlagRouteCommandAllInfo()
    {

    }
}

?>