<?php

use App\Chore\ConfigEnv;
use App\Chore\DatabaseInitConnection;
use App\Chore\Environment;


require_once dirname(__DIR__, 1) . '\\vendor\\autoload.php';


// Carregamento das variaveis de ambiente
Environment::loadEnvConfiguration(dirname(__DIR__, 1) . "\\.env");

// Carregamento das variaveis de ambiente acessiveis por meio de arquivo php (Ex: database.php)
ConfigEnv::load(dirname(__DIR__, 1) . "\\config");

/**
 * TODO: A conexão com o banco não deve ser feita no bootstrap, uma melhor forma seria criar um abstract Model com seu construtor
 * conectando ao banco de dados, assim sendo todo novo Model criado irá se conectar ao banco de dados automaticamente em sua instanciação.
 * Isso evitaria duplicação de código abaixo para qualquer utilização do banco de dados no sistema.
 * 
 * Ex: Para qualquer utilização do banco, atualmente:
 * $pdo = DatabaseInitConnection::get();
 * $dados = $pdo->algumacoisa();
 * 
 * Com abstract Model:
 * abstract class
 * class Model
 * protected PDO $pdo;
 * _construct(PDO $pdo){$this->pdo = $pdo;}  
 * 
 * Em qulquer model criado, extendido de Model:
 * $this->pdo->connection()->query("SELECT * FROM users");
 */
$pdo = DatabaseInitConnection::get();

// Carregamento das rotas
require dirname(__DIR__, 1) . '\\routes\\web.php';