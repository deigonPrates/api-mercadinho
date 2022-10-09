<?php

namespace app\controllers;

use PDO;

class HistoricoComprasController extends BaseController {

    public function get($venda_id){
        $stmt = $this->DB->prepare("SELECT * FROM venda_produtos  WHERE venda_id = :venda_id");
        $stmt->bindParam(':venda_id', $venda_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode($stmt->fetchAll(PDO::FETCH_OBJ));
            http_response_code(200);
        }else{
            echo json_encode($this->DB->errorInfo());
            http_response_code(500);
        }
    }

}


