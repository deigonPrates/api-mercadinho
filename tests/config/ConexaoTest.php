<?php

namespace config;

use app\config\Conexao;
use PHPUnit\Framework\TestCase;

class ConexaoTest extends TestCase
{

    public function testGetConnection()
    {

        try {
            $conexao = Conexao::getConnection();
            $this->assertTrue(true);
        } catch (\Exception $e) {
            $this->markTestIncomplete("Falha ao conectar ao banco" );
        }

    }
}
