<?php

namespace app\router;

use app\controllers\TipoControler;

class TipoRotas {

    public static function boot(){
        $tipo =  new TipoControler();

        switch($_SERVER["REQUEST_METHOD"]){
            case 'GET':
                if(!empty($_GET["id"])){
                    $id = intval($_GET["id"]);
                    $tipo->read($id);
                }else{
                    $tipo->list();
                }
            break;
            case 'POST':
                $tipo->create();
                break;
            case 'PUT':
                $id = intval($_GET["id"]);
                $tipo->update($id);
            break;
            case 'DELETE':
                $id = intval($_GET["id"]);  
                $tipo->delete($id);      
            break;
            default:
                header("HTTP/1.0 405 Method Not Allowed");
            break;
        }
    }
}
