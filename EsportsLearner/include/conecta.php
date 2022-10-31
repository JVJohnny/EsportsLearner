<?php
	$bd_host = "localhost";
    $bd_user = "root";
    $bd_pass = '';
    $bd_db   = "esportslearner";
    $bd_conn = mysqli_connect($bd_host, $bd_user, $bd_pass, $bd_db);
    mysqli_set_charset($bd_conn, "utf8");
	
    if (!$bd_conn) {
        echo "Erro ao conectar ao servidor {$bd_host} com o usuário {$bd_user}.";
    }

?>