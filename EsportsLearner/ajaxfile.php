<?php
include "include/conecta.php";
include "classes/usuario.php";
include "classes/comments.php";

session_start();

if (isset($_POST["userid"])) {
    $userid = $_POST["userid"];
    $_SESSION["cod"] = $userid;
}

$objUser = new Usuario($bd_conn);
$objComment = new Comments($bd_conn);






?>

  

<?php

if (isset($_SESSION["autenticado_usuario"])){

    $user = $_SESSION["autenticado_usuario"];

    $cod = $objUser->PegarCod($user);

    $sql2 = "select * from profileimg where userid =".$cod;

    $result2 = mysqli_query($bd_conn, $sql2);
    while ($row = mysqli_fetch_assoc($result2)) {
        $img = $row["name"];
        ?>
        <div class="container">
            <div class="row mb-1">
                <div class="col-2 ">
                <img src="img/<?php echo $img;?>" alt="" class="rounded-circle" style="width: 60px; height: 60px;">

                </div>
                <div class="col-10">
                    <form action="<?php echo $_SESSION["document"];?>?acao=comentar" method="post">
                <textarea name="comment" id="comment" placeholder="Adicione um comentário" class="form-control mb-1"  rows="3" required focus></textarea>
                <div class="col-12">

                
                <button data-id='<?php echo $_SESSION["cod"]; ?>' class="btn btn-primary btn-sm userinfo " style="margin-left: 78%" type="submit" >Comentar</button>
                </form>
                
                </div>
                
              

               
                </div>
               
                
            </div>
            <hr>
            <?php

}

}
?>
<?php
$sql = "select comment.comentario, DATE_FORMAT(comment.quando,'%d/%m às %Hh%im') as quando, profileimg.name, usuarios.usuario from comment inner join profileimg on comment.userid = 
profileimg.userid inner join usuarios on comment.userid = usuarios.cod_usuario where comment.cod_video=".$userid;
$result = mysqli_query($bd_conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $userprofile = $row["name"];
    $username = $row["usuario"];
    $quando = $row["quando"];
    $comentario = $row["comentario"];

?>
            <div class="row mb-5">
                <div class="col-2">
                <img src="img/<?php echo $userprofile;?>" alt="" class="rounded-circle" style="width: 60px; height: 60px;">


                </div>
                <div class="col-10">
                    <p class="mb-1"><b style="font-size: 20px;"><?php echo $username?></b> <?php echo $quando?></p>
                        <p><?php echo $comentario?></p>
                    
                    

                </div>

            </div>

            
        
        
<?php
}
?>
</div>

<?php

exit;

?>