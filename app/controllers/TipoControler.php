<?php

namespace app\controllers;

use PDO;

class TipoControler extends BaseController {

    public function list(){
        $result = $this->DB->query("SELECT * FROM tipos ORDER BY id DESC ")
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
            $stmt = $this->DB->prepare("INSERT INTO tipos (nome,imposto) VALUES(:nome,:imposto)");
            $stmt->bindParam(':nome',    $_POST['nome'], PDO::PARAM_STR);
            $stmt->bindParam(':imposto', $_POST['imposto'], PDO::PARAM_STR);
        
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
        $stmt = $this->DB->prepare("SELECT * FROM tipos WHERE id = :id");
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
            echo json_encode(['Tipo inválido']);
            http_response_code(401);
        }
        if(count($erros) > 0){
            echo json_encode($erros);
            http_response_code(406);
        }else{
            $this->DB->beginTransaction();
            $stmt = $this->DB->prepare("UPDATE tipos set nome=:nome, imposto=:imposto where id=:id");
            $stmt->bindParam(':id',      $id, PDO::PARAM_INT);
            $stmt->bindParam(':nome',    $_REQUEST['nome'], PDO::PARAM_STR);
            $stmt->bindParam(':imposto', $_REQUEST['imposto'], PDO::PARAM_STR);
        
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
            $stmt = $this->DB->prepare("DELETE FROM tipos WHERE id = :id");
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
            $erros[] = ['O nome é obrigatório'];
        }
        if(!isset($_REQUEST['imposto']) || empty($_REQUEST['imposto'])){
            $erros[] = ['O imposto é obrigatório'];

        }
        
        return $erros;
    }
}


