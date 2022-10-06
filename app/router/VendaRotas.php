<?php
include_once(getcwd().'/app/controllers/VendaControler.php');

class VendaRotas {

    public static function boot(){
        $venda = new VendaControler(); 

        switch($_SERVER["REQUEST_METHOD"]){
            case 'GET':
                if(!empty($_GET["id"])){
                    $id = intval($_GET["id"]);
                    $venda->read($id);
                }else{
                    $venda->list();
                }
            break;
            case 'POST':
                $venda->create();
                break;
            case 'PUT':
                $id = intval($_GET["id"]);
                $venda->update($id);
            break;
            case 'DELETE':
                $id = intval($_GET["id"]);  
                $venda->delete($id);      
            break;
            default:
                header("HTTP/1.0 405 Method Not Allowed");
            break;
        }
    }
}
