<?php

namespace controllers;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class ProdutoControlerTest extends TestCase
{
    private $endpoint = 'http://localhost:8080/produto/';
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
    public function testcriandoUmNovoEditandoRemovendoProduto(){
        $client = new Client();
        $response =  $client->post($this->endpoint, [
            'form_params' => [
                'nome'    => 'TestNome',
                'tipo_id' => '1',
                'valor' => '1'
            ],
        ]);

        $body = json_decode($response->getBody(), true);

        if($response->getStatusCode() === 201){

            if($this->atualizandoOid($body['id'])){
                $this->assertTrue(true, 'Atualizado com sucesso');
            }else{
                $this->markTestIncomplete("Falha ao atualizar: ".$body['id'] );
            }

            if($this->removendoOId($body['id'])){
                $this->assertTrue(true, 'Removido com sucesso');
            }else{
                $this->markTestIncomplete("Falha ao remover: ".$body['id'] );
            }
        }

        $this->assertEquals(201, $response->getStatusCode());
    }
    private function atualizandoOId($id): bool
    {
        $client = new Client();
        $response = $client->put($this->endpoint.'?id='.$id.'&nome=TestAtualizado&tipo_id=1&valor=1');
        if($response->getStatusCode() === 200){
            return true;
        }else{
            return false;
        }
    }
    private function removendoOId($id): bool
    {
        $client = new Client();
        $response = $client->delete($this->endpoint.'?id='.$id);
        if($response->getStatusCode() === 200){
            return true;
        }else{
            return false;
        }
    }
}
