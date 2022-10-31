<?php
	include "include/conecta.php";
	include "classes/usuario.php";
    include "classes/profileimg.php";
	
	$vName = $_POST["name"];
	$vEmail = $_POST["email"];
    $vUsuario = $_POST["username"];
    $vSenha = $_POST["senha"];
    $vSenharepeat = $_POST["senharepeat"];

	$objUsuario = new Usuario($bd_conn);
    $objProfile = new Profile($bd_conn);

    if ($vSenha == $vSenharepeat){
        if($objUsuario->Carregar($vUsuario) != true){
            $objUsuario->setName($vName);
            $objUsuario->setEmail($vEmail);
            $objUsuario->setUsuario($vUsuario);
            $objUsuario->setSenha($vSenha);
            $objUsuario->Inserir();

            $sql = "select * from usuarios where usuario ='$vUsuario' ";
            $result = mysqli_query($bd_conn, $sql);
            while ($row = mysqli_fetch_assoc($result)){
                $id = $row['cod_usuario'];
            }
            $objProfile->setUserid($id);
            $objProfile->setStatus(0);
            $objProfile->setName("user_profile.png");
            $objProfile->Inserir();

            header("location: index.php?msg=sucesso");


        } else {
            header("location: index.php?msg=usuario_errado");
        }

    }else {
        header("location: index.php?msg=senha_errada");
    }
    


?>