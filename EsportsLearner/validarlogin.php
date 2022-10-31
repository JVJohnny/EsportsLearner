<?php
	session_start();
	
	include "include/conecta.php";
	include "classes/usuario.php";
	
	$vUsuario = $_POST["edUsuario"];
	$vSenha = $_POST["edSenha"];
	$objUsuario = new Usuario($bd_conn);
	if ($objUsuario->Carregar($vUsuario)) {
		if ($objUsuario->getSenha() == $vSenha) {
			$_SESSION["autenticado_usuario"] = $objUsuario->getUsuario();

			

			header("location:".$_SESSION["document"]);
			
		} else {
			header("location:" .$_SESSION['document']."?msg=erro_login");
		}
	} else {
		header("location:".$_SESSION['document']."?msg=erro_login");
	}	
?>