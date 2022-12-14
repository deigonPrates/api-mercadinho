<?php

namespace app\controllers;

use PDO;

class ProdutoControler extends BaseController {

    protected $DB;

    public function list(){
        $result = $this->DB->query("SELECT produtos.*, tipos.nome as tipo_nome FROM produtos 
                                    left join tipos on tipos.id = produtos.tipo_id ORDER BY produtos.id DESC ")
                    ->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($result);
    }

    public function create(){
        $erros = $this->validAll();
        
        if(count($erros) > 0){
            echo json_encode($erros);
            http_response_code(406);
        }else{
            $this->DB->beginTransaction();
            $stmt = $this->DB->prepare("INSERT INTO produtos (nome,tipo_id,valor) VALUES(:nome,:tipo_id,:valor)");
            $stmt->bindParam(':nome',    $_POST['nome'], PDO::PARAM_STR);
            $stmt->bindParam(':tipo_id', $_POST['tipo_id'], PDO::PARAM_INT);
            $stmt->bindParam(':valor',   $_POST['valor'], PDO::PARAM_STR);
        
            if ($stmt->execute()) {
                $this->DB->commit();
                $this->read($this->DB->lastInsertId());
                http_response_code(201);
            }else{
                $this->DB->rollBack();
                echo json_encode($this->DB->errorInfo());
                http_response_code(500);
            }
        }
              
    }

    public function read($id){
        $stmt = $this->DB->prepare("SELECT produtos.*, tipos.imposto FROM produtos 
                                    left join tipos on tipos.id = produtos.tipo_id 
                                    WHERE produtos.id = :id ORDER BY produtos.id DESC");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode($stmt->fetch(PDO::FETCH_OBJ));
            http_response_code(200);
        }else{
            echo json_encode($this->DB->errorInfo());
            http_response_code(500);
        }

        
    }

    public function update($id){
        $erros = $this->validAll();
        if(!is_numeric($id) || empty($id)){

            echo json_encode(['Produto inv??lido']);
            http_response_code(401);
        }
        if(count($erros) > 0){
            echo json_encode($erros);
            http_response_code(406);
        }else{
            $this->DB->beginTransaction();
            $stmt = $this->DB->prepare("UPDATE produtos set nome=:nome, tipo_id=:tipo_id, valor=:valor where id=:id");
            $stmt->bindParam(':id',      $id, PDO::PARAM_INT);
            $stmt->bindParam(':nome',    $_REQUEST['nome'], PDO::PARAM_STR);
            $stmt->bindParam(':tipo_id', $_REQUEST['tipo_id'], PDO::PARAM_INT);
            $stmt->bindParam(':valor',   $_REQUEST['valor'], PDO::PARAM_STR);
        
            if ($stmt->execute()) {
                $this->DB->commit();
                $this->read($id);
                http_response_code(200);
            }else{
                $this->DB->rollBack();
                echo json_encode($this->DB->errorInfo());
                http_response_code(500);
            }
        }
    }

    public function delete($id){

        try {
            $this->DB->beginTransaction();
            $stmt = $this->DB->prepare("DELETE FROM produtos WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);        
            if ($stmt->execute()) {
                $this->DB->commit();
                echo json_encode(['Removido com sucesso']);
                http_response_code(200);
            }else{
                $this->DB->rollBack();
                echo json_encode($this->DB->errorInfo());
                http_response_code(500);
            }
        }catch (\Exception $e) {
            echo json_encode($e);
            http_response_code(500);
        }
    }

    private function validAll(){
        $erros = [];
        if(!isset($_REQUEST['nome']) || empty($_REQUEST['nome'])){
            $erros[] = ['O nome ?? obrigat??rio'];
        }
        if(!isset($_REQUEST['tipo_id']) || empty($_REQUEST['tipo_id'])){
            $erros[] = ['O tipo do item ?? obrigat??rio'];

        }if(!isset($_REQUEST['valor']) || empty($_REQUEST['valor'])){
            $erros[] = ['O valor ?? obrigat??rio'];
        }
        return $erros;
    }
}


