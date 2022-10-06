<?php
include_once(getcwd().'/config/db.php');

class ProdutoControler {

    private $DB;

    public function __construct() {
        $this->DB = Conexao::getConnection();
    }

    public function list(){
        $result = $this->DB->query("SELECT * FROM produtos ORDER BY id DESC ")->fetchAll(PDO::FETCH_OBJ);
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
                echo json_encode($this->db->errorInfo());
                http_response_code(500);
            }
        }
              
    }

    public function read($id){
        $result = $this->DB->query("SELECT * FROM produtos WHERE id = $id")->fetch(PDO::FETCH_OBJ);
        echo json_encode($result);
    }

    public function update($id){
        $erros = $this->validAll();
        if(!is_numeric($id) || empty($id)){

            echo json_encode(['Produto inválido']);
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
                echo json_encode($this->db->errorInfo());
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
                echo json_encode($this->db->errorInfo());
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
        if(!isset($_REQUEST['tipo_id']) || empty($_REQUEST['tipo_id'])){
            $erros[] = ['O tipo do item é obrigatório'];

        }if(!isset($_REQUEST['valor']) || empty($_REQUEST['valor'])){
            $erros[] = ['O valor é obrigatório'];
        }
        return $erros;
    }
}


