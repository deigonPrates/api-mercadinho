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
        $json     = file_get_contents('php://input');
        $request  = json_decode($json, true);
        $erros    = $this->validAll($request);
        
        if(count($erros) > 0){
            echo json_encode($erros);
            http_response_code(406);
        }else{
            $data = DATE('Y-m-d');
            $this->DB->beginTransaction();
            try {
                $stmt = $this->DB->prepare("INSERT INTO vendas (valor, data, imposto, quantidade) VALUES(:valor, :data, :imposto, :quantidade)");
                $stmt->bindParam(':data',        $data,                  PDO::PARAM_STR);
                $stmt->bindParam(':valor',       $request['valor'],      PDO::PARAM_STR);
                $stmt->bindParam(':imposto',     $request['imposto'],    PDO::PARAM_STR);
                $stmt->bindParam(':quantidade',  $request['quantidade'], PDO::PARAM_STR);
            
                if ($stmt->execute()) {
                    $this->DB->commit();
                    $this->setVendaProdutos($request['itens'], $this->DB->lastInsertId());
                    http_response_code(201);
                }else{
                    $this->DB->rollBack();
                    echo json_encode($this->db->errorInfo());
                    http_response_code(500);
                }
            } catch (\Throwable $th) {
                $this->DB->rollBack();
                echo json_encode($th);
                http_response_code(500);
            }
        }
              
    }

    public function read($id){
        $result = $this->DB->query("SELECT * FROM vendas WHERE id = $id")->fetch(PDO::FETCH_OBJ);
        echo json_encode($result);
    }

    public function update($id){
        echo " A venda não pode ser editada";
        http_response_code(405);
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

    private function setVendaProdutos($items, $venda_id){
        foreach($items as $item){
            $stmt = $this->DB->prepare("INSERT INTO venda_produtos (produto_id, venda_id, descricao, quantidade, preco_unitario, impostos, valor_total) VALUES(:produto_id, :venda_id, :descricao, :quantidade, :preco_unitario, :impostos, :valor_total)");
            $stmt->bindParam(':venda_id',       $venda_id,               PDO::PARAM_INT);
            $stmt->bindParam(':produto_id',     $item['id'],            PDO::PARAM_INT);
            $stmt->bindParam(':descricao',      $item['descricao'],      PDO::PARAM_STR);
            $stmt->bindParam(':quantidade',     $item['quantidade'],     PDO::PARAM_INT);
            $stmt->bindParam(':preco_unitario', $item['preco_unitario'], PDO::PARAM_STR);
            $stmt->bindParam(':impostos',       $item['impostos'],       PDO::PARAM_STR);
            $stmt->bindParam(':valor_total',    $item['valor_total'],    PDO::PARAM_STR);

            if (!$stmt->execute()) {
                throw new Exception('Falha ao inserir o item'+$item['id']);
                break;
            }
        }
    }

    private function validAll($data){
        $erros = [];
        if(!isset($data['imposto']) || empty($data['imposto'])){
            $erros[] = ['O valor do imposto é obrigatório'];
        }
        if(!isset($data['valor']) || empty($data['valor'])){
            $erros[] = ['O valor é obrigatório'];
        }
        if(!isset($data['quantidade']) || empty($data['quantidade'])){
            $erros[] = ['O valor é obrigatório'];
        }
        if(!isset($data['itens']) || empty($data['itens'])){
            $erros[] = ['Itens desconhecidos'];
        }       
        
        return $erros;
    }

}


