<?php

namespace app\config;

use Exception;
use PDO;
use PDOException;

define('DB_HOST'     , "localhost");
define('DB_USER'     , "user");
define('DB_PASSWORD' , "123456789");
define('DB_NAME'     , "mercado");


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