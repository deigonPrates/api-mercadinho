<?php

namespace controllers;

use app\controllers\VendaControler;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use PHPUnit\Framework\TestCase;

class VendaControlerTest extends TestCase
{
    private $endpoint = 'http://localhost:8080/venda/';

    public function testList()
    {
        $client = new Client();
        $response =  $client->get($this->endpoint);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testRead()
    {
        $client = new Client();
        $response =  $client->get($this->endpoint.'?id=1');
        $this->assertEquals(200, $response->getStatusCode());
    }
}
