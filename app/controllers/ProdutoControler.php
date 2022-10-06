<?php
include_once(getcwd().'/config/db.php');

class ProdutoControler {

    private $DB;

    public function __construct() {
        $this->DB = Conexao::getConnection();
    }

    public function list(){
        $result = $this->DB->query("SELECT * FROM produtos ORDER BY nome ASC ")->fetchAll();
        echo json_encode($result);
    }

    public function create(){}

    public function read($id){
        $result = $this->DB->query("SELECT * FROM produtos WHERE id = $id")->fetch();
        echo json_encode($result);
    }

    public function update($id){}

    public function delete($id){}
}


