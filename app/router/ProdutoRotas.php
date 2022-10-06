<?php
include_once(getcwd().'/app/controllers/ProdutoControler.php');

class ProdutoRotas {

    public static function boot(){
        $produto =  new ProdutoControler(); 

        switch($_SERVER["REQUEST_METHOD"]){
            case 'GET':
                if(!empty($_GET["id"])){
                    $id = intval($_GET["id"]);
                    $produto->read($id);
                }else{
                    $produto->list();
                }
            break;
            case 'POST':
                $produto->create();
                break;
            case 'PUT':
                $id = intval($_GET["id"]);
                $produto->update($id);
            break;
            case 'DELETE':
                $id = intval($_GET["id"]);  
                $produto->delete($id);      
            break;
            default:
                header("HTTP/1.0 405 Method Not Allowed");
            break;
        }
    }
}
