<?php

class Comments{

private $conexao;
private $comentario;
private $cod_video;
private $quando;
private $userid;

public function getConexao() { 
    return $this->conexao; 
}

public function setConexao($conexao) { 
    $this->conexao = $conexao; 

}

public function getComentario() {
    return $this->comentario;

}

public function setComentario($comentario) {
    $this->comentario = $comentario;
}

public function getCod_video() {

    return $this->cod_video;
}

public function setCod_video($cod_video) {
    $this->cod_video = $cod_video;
}

public function getQuando(){
    return $this->quando;

}

public function setQuando($quando){
    $this->quando = $quando;

}

public function getUserID(){
    return $this->userid;

}

public function SetUserID($userid){
    $this->userid = $userid;

}

public function __construct($conexao) {
    $this->conexao = $conexao;
}

public function Inserir(){
    $sql = "INSERT INTO comment(comentario, cod_video, quando, userid) VALUES (?, ?, ?, ?)";
	$insert_preparado = $this->conexao->prepare($sql);
	$insert_preparado->bind_param('sisi', $this->comentario, $this->cod_video, $this->quando, $this->userid);
    return $insert_preparado->execute();

}

}
?>