<?php 

namespace App\Cli\Commands;

abstract class Command
{
    /**
     * Metodo abstrato responsavel por manipular os argumentos e imprimir suas responsabilidades
     * @param array $args
     * @return void
     */
    abstract public function handle(array $args): void;

    /**
     * Metodo abstrato responsavel por imprimir ajuda ao realizar um comando especificado na lista de comandos
     * @return void
     */
    abstract public static function help(): void;
}