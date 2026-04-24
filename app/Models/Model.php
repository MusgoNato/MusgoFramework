<?php 


namespace App\Models;

use PDO;

abstract class Model 
{
    public $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }    
}