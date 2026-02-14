<?php



namespace App\Chore;

use PDO;
use PDOException;

class DatabaseInitConnection
{
    protected static ?PDO $connection = null;

    public static function get()
    {
        if(self::$connection !== null) 
        {
            return self::$connection;
        }
        
        $conn = config('database.conn');
        $host = config('database.host');
        $db   = config('database.name');
        $user = config('database.user');
        $pass = config('database.pass');
        $port = config('database.port');

        $dsn = "{$conn}:host={$host};dbname={$db};port={$port};charset=utf8mb4";
        
        try 
        {
            self::$connection = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);

            return self::$connection;

        }catch(PDOException $e) 
        {
            die("Erro ao conectar no banco: " . $e->getMessage());
        }
    }
}