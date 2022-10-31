<?php

class Profile{

private $conexao;
private $userid;
private $status;
private $name;

public function getConexao() { 
    return $this->conexao; 
}

public function setConexao($conexao) { 
    $this->conexao = $conexao; 

}

public function getUserid() {
    return $this->userid;

}

public function setUserid($userid) {
    $this->userid = $userid;
}

public function getStatus() {

    return $this->status;
}

public function setStatus($status) {
    $this->status = $status;
}

public function getName(){
    return $this->name;

}

public function setName($name){
    $this->name = $name;

}

public function __construct($conexao) {
    $this->conexao = $conexao;
}

public function Inserir(){
    $sql = "INSERT INTO profileimg(userid, name, status) VALUES (?, ?, ?)";
	$insert_preparado = $this->conexao->prepare($sql);
	$insert_preparado->bind_param('isi', $this->userid, $this->name, $this->status);
    return $insert_preparado->execute();

}

}
?>