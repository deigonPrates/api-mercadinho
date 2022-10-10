<?php

namespace app\config;

use Exception;
use PDO;
use PDOException;

define('DB_HOST'     , getenv('DB_HOST'));
define('DB_USER'     , getenv('DB_USER'));
define('DB_PASSWORD' , getenv('DB_PASSWORD'));
define('DB_NAME'     , getenv('DB_NAME'));


class Conexao
{
    private static $connection;

    private function __construct(){}

    public static function getConnection(): PDO
    {

        $dsn = "pgsql:host=".DB_HOST.";port=5432;dbname=".DB_NAME.";";

        try {
            if(!isset($connection)){
                $connection =  new PDO($dsn, DB_USER, DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            }
            return $connection;
         } catch (PDOException $e) {
            $mensagem = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
            $mensagem .= "\nErro: " . $e->getMessage();
            throw new Exception($mensagem);
         }
     }
}