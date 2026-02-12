<?php 

namespace App\Cli;

use App\Cli\Commands\ControllerCommand;
use App\Cli\Commands\HelpCommand;
use App\Cli\Commands\RouteListCommand;
use App\Helpers\TerminalColors;

class Application
{
    protected array $commands = [];
    public function __construct()
    {
        $this->registerDefaultComands();
    }

    /**
     * Summary of run
     * @return void
     */
    public function run(array $arvg)
    {
        // 
        array_shift($arvg);
        $commandName = $arvg[0] ?? 'help';

        if(!isset($this->commands[$commandName]))
        {
            echo TerminalColors::TEXT['red'] 
            . "Comando '{$commandName}' não encontrado. Digite"
            . TerminalColors::TEXT['white'] . " php musgo help " 
            . TerminalColors::TEXT['red'] 
            . "para listar os comandos disponíveis!" 
            . TerminalColors::RESET;
            return;
        }
        else
        {
            $command = new $this->commands[$commandName];
            $command->handle(array_slice($arvg, 1));
        }

    }


    /**
     * Summary of registerDefaultComands
     * @return void
     */
    protected function registerDefaultComands(): void
    {
        $this->commands = [
            'help' => HelpCommand::class,
            'routes' => RouteListCommand::class,
            'controller' => ControllerCommand::class,
        ];
    } 
}
?>