<?php
    
    if (isset($_SESSION["autenticado_usuario"])) {
        if ($_SESSION["autenticado_usuario"] == "") {
            header("location: sair.php");
        }
    } else {
        header("location: index.php");
    } 
?>