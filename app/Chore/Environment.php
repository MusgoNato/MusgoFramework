<?php

namespace App\Chore;

use Exception;

class Environment
{
    /**
     * Método responsável pelo carregamento das váriaveis de ambiente no ambiente do Framework
     * @param string $path
     * @throws Exception
     * @return void
     */
    public static function loadEnvConfiguration(string $path): void
    {
        if(!file_exists($path)) 
        {
            throw new Exception("Arquivo .env não existe!");
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach($lines as $line) 
        {

            // Ignora comentários
            if(str_starts_with(trim($line), '#')) 
            {
                continue;
            }

            // Se não tiver =, ignora
            if(!str_contains($line, '=')) 
            {
                continue;
            }

            [$name, $value] = explode('=', $line, 2);

            $name = trim($name);
            $value = trim($value);

            // Remove aspas se existirem
            if(
                (str_starts_with($value, '"') && str_ends_with($value, '"')) ||
                (str_starts_with($value, "'") && str_ends_with($value, "'"))
            ){
                $value = substr($value, 1, -1);
            }

            // Define nas variáveis globais
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
            putenv("$name=$value");
        }
    }
}
