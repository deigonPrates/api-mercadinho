<?php

namespace controllers;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class HistoricoComprasControllerTest extends TestCase
{

    public function testGet()
    {
        $client = new Client();
        $response =  $client->get('http://localhost:8080/historico/?id=1');
        $this->assertEquals(200, $response->getStatusCode());
    }
}
