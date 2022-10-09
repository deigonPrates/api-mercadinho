<?php

namespace app\controllers;

use app\config\Conexao;

class BaseController
{
    protected $DB;

    public function __construct() {
        try {
            $this->DB = Conexao::getConnection();
        } catch (\Exception $e) {
            die("Falha ao tentar se conectar ao banco");
        }
    }

}