<?php



namespace App\Cli\Commands;

use App\Helpers\TerminalColors;

class ControllerCommand extends Command
{
    public function handle(array $args): void
    {
        $nameController = array_shift($args);
        
        if(empty($nameController))
        {
            echo TerminalColors::TEXT['red'] . "Adicione um nome para o Controller" . TerminalColors::RESET;
            return;
        }

        $fileNameController = ucfirst($nameController);
        
        $path = dirname(__DIR__, 2) . "\\Http\\Controllers\\$fileNameController" . ".php";
        
        $file = fopen($path, 'w+');

        file_put_contents($path, $this->writeController($fileNameController));

        fclose($file);

    }


    public static function help(): void 
    {
        // 
    }


    private function writeController(string $fileNameController): string
    {        
        return <<<PHP
        <?php
        
        namespace App\Http\Controllers;

        class $fileNameController
        {
            // 
        }
        
        PHP;
    }
}