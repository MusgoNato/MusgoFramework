<?php 

namespace App\Cli;

use App\Cli\Commands\RouteListCommand;


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
            echo "Comando {$commandName} nao encontrado!";
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
            'route::list' => RouteListCommand::class,
        ];
    } 
}
?>