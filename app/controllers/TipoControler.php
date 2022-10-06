<?php
include_once(getcwd().'/config/db.php');

class TipoControler {

    private $DB;

    public function __construct() {
        $this->DB = Conexao::getConnection();
    }

    public function list(){
        $result = $this->DB->query("SELECT * FROM tipos ORDER BY nome ASC ")->fetchAll();
        echo json_encode($result);
    }

    public function create(){}

    public function read($id){
        $result = $this->DB->query("SELECT * FROM tipos WHERE id = $id")->fetch();
        echo json_encode($result);
    }

    public function update($id){}

    public function delete($id){}
}


