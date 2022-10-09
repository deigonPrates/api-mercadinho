<?php
include_once(getcwd().'/config/db.php');

class HistoricoComprasController {

    private $DB;

    public function __construct() {
        $this->DB = Conexao::getConnection();
    }

    public function get($venda_id){
        $stmt = $this->DB->prepare("SELECT * FROM venda_produtos  WHERE venda_id = :venda_id");
        $stmt->bindParam(':venda_id', $venda_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode($stmt->fetchAll(PDO::FETCH_OBJ));
            http_response_code(200);
        }else{
            echo json_encode($this->db->errorInfo());
            http_response_code(500);
        }
    }

}


