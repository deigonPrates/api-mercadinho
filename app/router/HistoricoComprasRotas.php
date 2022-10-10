<?php

namespace app\router;

use app\controllers\HistoricoComprasController;

class HistoricoComprasRotas {

    public static function boot(){
        $historicoCompra = new HistoricoComprasController(); 

        switch($_SERVER["REQUEST_METHOD"]){
            case 'GET':
                if(!empty($_GET["id"])){
                    $id = intval($_GET["id"]);
                    $historicoCompra->get($id);
                }else{
                    http_response_code(406);
                }
            break;
            default:
                http_response_code(400);
            break;
        }
    }
}
