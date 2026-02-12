<?php 

namespace App\Cli\Commands;

use App\Cli\Commands\Command;
use App\Helpers\TerminalColors;

class HelpCommand extends Command
{
   public function handle(array $args): void
   {      
      echo TerminalColors::TEXT['yellow'] . "Comandos disponíveis:\n" 
      . TerminalColors::TEXT['green'] 
      . "\troutes\t" . TerminalColors::TEXT['white'] . "=>\t" . TerminalColors::TEXT['cyan'] . "Lista as informações básicas de todas as rotas disponíves na aplicação\n"
      . TerminalColors::TEXT['green']
      . "\tcontroller\t" . TerminalColors::TEXT['white'] . "=>\t" . TerminalColors::TEXT['cyan'] . "Criação de controllers\n"      
      . TerminalColors::RESET;
   }


   public static function help(): void
   {
      // 
   }
}
?>