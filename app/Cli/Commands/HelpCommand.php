<?php 

namespace App\Cli;

use App\Cli\Commands\Command;

class HelpCommand extends Command
{
   public function handle(array $args): void
   {      
      echo "\e[33mComandos disponíveis:\e[032m 
      route::list \e[34m Lista todas as rotas disponíves na aplicação
      \e[0m";
   }


   public static function help(): void
   {
      // 
   }
}
?>