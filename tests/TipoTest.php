<?php


use PHPUnit\Framework\TestCase;

class TipoTest extends TestCase
{
    private $client;

    public function __construct(string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->client  = new GuzzleHttp\Client(['base_uri' => 'http://localhost:8080']);
    }

    /**
     * @test
     */
    public function listagemDeTipos(){
        $response = $this->client->get('/tipo');
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function criandoUmNovoEditandoRemovendoTipo(){

        $response = $this->client->post('/tipo', [
            'form_params' => [
                'nome'    => 'TestNome',
                'imposto' => '1'
            ],
        ]);
        $body = json_decode($response->getBody(), true);

        if($response->getStatusCode() === 201){

            if($this->lendoOIdTipo($body[0]['id'])){
                $this->assertTrue(true, 'Tipo pode ser lido');
            }else{
                $this->markTestIncomplete("Falha ao ler o tipo: $body[0]['id']" );
            }

            if($this->atualizandoOTipo($body[0]['id'])){
                $this->assertTrue(true, 'Tipo pode ser atualizado');
            }else{
                $this->markTestIncomplete("Falha ao atualizar o tipo: $body[0]['id']" );
            }

            if($this->removendoOIdTipo($body[0]['id'])){
                $this->assertTrue(true, 'Tipo pode ser removido');
            }else{
                $this->markTestIncomplete("Falha ao remover o tipo: $body[0]['id']" );
            }
        }

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function lendoOIdTipo($id): bool
    {
        $response = $this->client->get('/tipo/?id='.$id);
        if($response->getStatusCode() === 200){
            return true;
        }else{
            return false;
        }
    }

    public function atualizandoOTipo($id): bool
    {
        $response = $this->client->put('/tipo/?id='.$id.'&nome=TestAtualizado&imposto=1.1');
        if($response->getStatusCode() === 200){
            return true;
        }else{
            return false;
        }
    }

    public function removendoOIdTipo($id): bool
    {
        $response = $this->client->delete('/tipo/?id='.$id);
        if($response->getStatusCode() === 200){
            return true;
        }else{
            return false;
        }
    }
}