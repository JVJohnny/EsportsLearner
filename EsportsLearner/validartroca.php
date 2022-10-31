<?php
	session_start();

	include "include/conecta.php";
	include "classes/usuario.php";
    $objUser = new Usuario($bd_conn);
    $conexao = $objUser->getConexao();
    $user = $_SESSION["autenticado_usuario"];

    $sql = "select * from usuarios where usuario = ?";

    $select_preparado = $conexao->prepare($sql);
    $select_preparado->bind_param('s', $user);
    $select_preparado->execute();

    $resultados = $select_preparado->get_result();
    if ($resultados->num_rows > 0) {             
    $registro = $resultados->fetch_object(); 
    
    }

   
            $vsenha = $_POST["Vsenha"];
            $vnsenha = $_POST["Vnsenha"];
            $vnsenha2 = $_POST["Vnsenha2"];
            echo "asduhasudh";
            echo $registro->senha;
            if ($vsenha == $registro->senha) {
                if($vnsenha == $vnsenha2) {
                    $objUser->setSenha($vnsenha);
                    $objUser->setUsuario($user);
                    $objUser->TrocaSenha();
                    header("location: profile.php");

                }

            }


            

?>