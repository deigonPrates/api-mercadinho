<?php
include_once(getcwd().'/config/db.php');

class VendaControler {

    private $DB;

    public function __construct() {
        $this->DB = Conexao::getConnection();
    }

    public function list(){
        $result = $this->DB->query("SELECT * FROM vendas ORDER BY id DESC ")->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($result);
    }

    public function create(){
        $erros = $this->validAll();
        
        if(count($erros) > 0){
            echo json_encode($erros);
            http_response_code(406);
        }else{
            $data = DATE('Y-m-d');
            $this->DB->beginTransaction();
            $stmt = $this->DB->prepare("INSERT INTO vendas (produto_id, data) VALUES(:produto_id,:data)");
            $stmt->bindParam(':produto_id', $_POST['produto_id'], PDO::PARAM_STR);
            $stmt->bindParam(':data',       $data, PDO::PARAM_STR);
        
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
        $result = $this->DB->query("SELECT * FROM vendas WHERE id = $id")->fetch(PDO::FETCH_OBJ);
        echo json_encode($result);
    }

    public function update($id){
        $erros = $this->validAll();
        if(!is_numeric($id) || empty($id)){

            echo json_encode(['Venda inválida']);
            http_response_code(401);
        }
        if(count($erros) > 0){
            echo json_encode($erros);
            http_response_code(406);
        }else{
            $data = DATE('Y-m-d');
            $this->DB->beginTransaction();
            $stmt = $this->DB->prepare("UPDATE vendas set produto_id=:produto_id, data = :data where id=:id");
            $stmt->bindParam(':id',         $id, PDO::PARAM_INT);
            $stmt->bindParam(':produto_id', $_REQUEST['produto_id'], PDO::PARAM_STR);
            $stmt->bindParam(':data',       $data, PDO::PARAM_STR);
        
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
            $stmt = $this->DB->prepare("DELETE FROM vendas WHERE id = :id");
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
        if(!isset($_REQUEST['produto_id']) || empty($_REQUEST['produto_id'])){
            $erros[] = ['O produto é obrigatório'];
        }
        
        return $erros;
    }
}


