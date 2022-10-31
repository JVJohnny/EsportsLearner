<?php
            
            
            include "topo.php";

            if(!isset($_SESSION["autenticado_usuario"])){
                include "controlarsessao.php";
                exit;
            }


            include "classes/usuario.php";
            include "classes/videos.php";
			include "include/conecta.php";
            include "classes/rating.php";
            $objUser = new Usuario($bd_conn);
            $objRating = new Rating($bd_conn);
            $conexao = $objUser->getConexao();
            $user = $_SESSION["autenticado_usuario"];
            $cod_user = $objUser->PegarCod($_SESSION["autenticado_usuario"]);
		    $sql = "select * from usuarios where usuario = ?";

            $select_preparado = $conexao->prepare($sql);
			$select_preparado->bind_param('s', $user);
            $select_preparado->execute();

            $resultados = $select_preparado->get_result();
            if ($resultados->num_rows > 0) {             
            $registro = $resultados->fetch_object(); 
            
            }

            if(isset($_GET["acao"])){
                
                if(($_GET["acao"]) == "trocar"){
                    $vsenha = $_POST["Vsenha"];
                    $vnsenha = $_POST["Vnsenha"];
                    $vnsenha2 = $_POST["Vnsenha2"];
                    
                    if ($vsenha == $registro->senha) {
                        if($vnsenha == $vnsenha2) {
                            $objUser->setSenha($vnsenha);
                            $objUser->setUsuario($user);
                            $objUser->TrocaSenha();
                    
                            header("location: profile.php?msg=success");

                        }

                    }

                }
                if(($_GET["acao"]) == "compartilhar"){
                    $vURL = $_POST["Url"];
                    $vcategoria = $_POST["categoria"];
                    $vtitulo = $_POST["titulo"];
                    $cod_user2 = $objUser->PegarCod($_SESSION["autenticado_usuario"]);
                    $objVideos = new Videos($bd_conn);
                    
                    if ($objVideos->Carregar($vURL) == false) {

                    
                    $objVideos->setURL($vURL);
                    $objVideos->setCategoria($vcategoria);
                    $objVideos->setTitulo($vtitulo);
                    $objVideos->setCod_usuario($cod_user2);
                    $objVideos->setMedia(Null);
                    $objVideos->Inserir();
                    header ("location: profile.php?msg=inserido");


                } else {
                    header ("location: profile.php?msg=alreadyshared");
                }
                    



                    }

            }
           
        
 ?>
      



<style>

    img{
        width:100%;
        height:215px;

    }
</style>



<body>


    <div class="container mt-4 ">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body text-center ">
                        <?php
                            $sql = "select * from usuarios where usuario = '$_SESSION[autenticado_usuario]'";
                            $result = mysqli_query($bd_conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['cod_usuario'];
                                $sqlImg = "select * from profileimg where userid = '$id'";
                                $resultImg = mysqli_query($bd_conn, $sqlImg);
                                while($rowImg = mysqli_fetch_assoc($resultImg)) {
                                    if ($rowImg['status'] == 1) {
                                      
                                        
                                           echo "<img src='img/".$rowImg['name']."'".mt_rand()." class='mb-3 rounded-circle img-fluid' style='height: 160px; width: 160px; '>"; 
                                        
                                    } else {
                                        echo "<img src='img/".$rowImg['name']."' class='mb-3 rounded-circle img-fluid' style='width: 150px;'>";
                                    }
                                }
                            }
                        ?>
                        
                
                        
                    <form class="form" id="myform" action="" method="POST" enctype="multipart/form-data">
                        

                    <i class="fa-solid fa-camera uploadCam" ></i>
                        <input class="form-control-file uploadSets " type="file" name="file" id="file" onchange="javascript:this.form.submit();">
  
                    </form>

                    <?php
          if(isset($_FILES["file"]["name"])){
            
            $objUser = new Usuario($bd_conn);

            $id = $objUser->PegarCod($_SESSION["autenticado_usuario"]);


                $file = $_FILES['file'];

                $fileName = $_FILES['file']['name'];
                $fileTmpName = $_FILES['file']['tmp_name'];
                $fileSize = $_FILES['file']['size'];
                $fileError = $_FILES['file']['error'];
                $fileType = $_FILES['file']['type'];

                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));

                $allowed = array('jpg', 'jpeg', 'png');

                if(in_array($fileActualExt, $allowed)) {
                    if ($fileError === 0) {
                        if($fileSize < 1000000) {
                            $fileNameNew = "profile".$id.".".$fileActualExt;
                            $fileDestination = 'img/'.$fileNameNew;
                            move_uploaded_file($fileTmpName, $fileDestination);
                            $sql = "update profileimg set status = 1, name = '$fileNameNew' where userid = '$id'";
                            $result = mysqli_query($bd_conn, $sql);
                            header("location: profile.php");
                            

                                        } else {

                                            ?>

                                            <script>
                                Swal.fire({
                            icon: 'error',
                            title: 'Algo deu errado!',
                            text: 'Essa imagem é muito grande!',
                           
                            })
                                </script>
                
                                <?php
                                            
                                
                            }

                        } else {
                            ?>

                            <script>
                Swal.fire({
            icon: 'error',
            title: 'Algo deu errado!',
            text: 'Erro no upload!',
           
            })
                </script>

                <?php
                           
                        }

                    } else {
                        ?>

                        <script>
                Swal.fire({
            icon: 'error',
            title: 'Algo deu errado!',
            text: 'Este tipo de arquivo não é aceito!',
           
            })
                </script>

                        <?php
                       
                    }



        }



        ?>
  

                   
                    <h5 class="my-1"><?php echo $registro->usuario; ?></h5>



                    <?php 

                        $sqlN = "select count(cod_usuario) as contador from videos where cod_usuario = '$cod_user'";
                        $result = mysqli_query($bd_conn, $sqlN);
                        while ($row = mysqli_fetch_assoc($result)){
                            $id = $row['contador'];
                        }

                        $sqlNotas = "select count(cod_notas) as contar from rating where cod_notas = '$cod_user'";
                        $result2 = mysqli_query($bd_conn, $sqlNotas);
                        while ($row2 = mysqli_fetch_assoc($result2)){
                            $id2 = $row2['contar'];
                        }

                    ?>

                    <p class="text-muted mb-1"><?php echo "<b>$id</b>" ?> vídeos compartilhados</p>

                    <p class="text-muted mb-1"><?php echo "<b>$id2</b>" ?> vídeos avaliados</p>


                    <script type="text/javascript">
                        $('#file').change(function() {
                    $('#myform').submit();
                    });
                    
                </script>

    
    
                </div>
            </div>
        </div>

       
            

            <div class="col-md-8">
                <div class="card ">
                    <div class="card-body text-left">
                        <div class="row">
                            <div class="col-md-4 ">
                                <p class="mb-0">Nome Completo</p> 

                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-0"><?php echo $registro->name; ?></p>

                            </div>
                          
                            
                       
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-0"><?php echo $registro->email; ?></p>

                            </div>
                          
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 ">
                                <p class="mb-0">Senha</p>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <?php 
                                 
                                ?>
                              
           
                                    
                                    <div class="input-group">
                                    <input class="form-control form-control-sm" type="password"  value=<?php echo $registro->senha; ?>  id="myInput" disabled>
                                    
                                    <div class="input-group-append">
                                        <button name="bttrocar" onclick=mostrarSenha(); class="btn btn-sm btn-primary" type="button"><i class="fa-solid fa-eye-slash"></i></button>
                                    </div>
                                        
                                    </div>
                                
                               
                                      
                                    </div>

                          
                          
                </div>

                



              



                
            </div>
            
            




        </div>
        <div class="row">
        <div class="col-md-6">
                     <div class="card mt-4 ">
                          <div class="card-header cards ">
                              <a class="btn btn-dark d-flex justify-content-center" data-toggle="collapse" href="#TrocarSenha" role="button" aria-controls="TrocarSenha">
                                   Trocar de Senha
                               </a>
                          </div>
                        <div class="collapse" id="TrocarSenha">
                     <div class="card-body">

                        <form  method="post" action="profile.php?acao=trocar">
                            
                        <div class="form-floating mb-3">
                        <input class="form-control" type="password" name="Vsenha" placeholder="Senha Atual" required autofocus>
                        </div>
                        <div class="form-floating mb-3">
                        <input class="form-control " type="password" name="Vnsenha" placeholder="Nova senha" required>
                        </div>
                        <div class="form-floating mb-3">
                        <input class="form-control " type="password" name="Vnsenha2" placeholder="Nova senha novamente" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Trocar</button>
                     
                        </form>
                     
                        </div>
                    </div>

                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="card mt-4 ">
                          <div class="card-header cards ">
                              <a class="btn btn-dark d-flex justify-content-center" data-toggle="collapse" href="#ComVideos" role="button" aria-controls="ComVideos">
                                   Compartilhar Videos
                               </a>
                          </div>
                          <div class="collapse" id="ComVideos">
                     <div class="card-body">
                        <form action="profile.php?acao=compartilhar" method="post">

                            <div class="form-group">
                                
                            <input class="form-control mb-3" type="text" name="Url" placeholder="Url">

                            </div>
                            <div class="form-group">
                                
                            <select class="form-control mt-3 mb-3" name="categoria">
                                
                                <option selected disabled>Escolha a categoria...</option>
                                 <option>Counter-Strike</option>
                                 <option>League of Legends</option>
                                 <option>Valorant</option>

                            </div>

                            <div class="form-group">
                            
                                <textarea name="titulo" id="titulo" placeholder="Escreva o titulo" class="form-control"  rows="3"></textarea>
                            </div>
                        
                  
                        <button class="btn btn-success btn-block" type="submit">Compartilhar</button>
                        </form>
                     
                        </div>

            </div>
          
            </div>

             
</div>
</div>
</div>
</div>

<?php
        function vid($url){
            $video_url = trim($url);
            $params = parse_url($video_url);

            parse_str($params['query'], $query);

            return $query['v'];

        }
    ?>
  
        <div class="container">
            <hr class="mt-4">
         </div>  
                <?php
					$sql2 = "select cod_videos, url_embed, titulo, media from videos where cod_usuario = ? order by media desc";
                    $select_preparado2 = $conexao->prepare($sql2);
                    $select_preparado2->bind_param('i', $cod_user);
                     $select_preparado2->execute();

                     $resultados2 = $select_preparado2->get_result();
                     if ($resultados2->num_rows > 0) {
                        ?>
                         <div class="container">
                         <div class="row">
                <div class="col">
                    <h1 class="mb-4 my-4">Meus Vídeos...</h1>

                </div>
                
            </div>
                     </div>
                        <div class="container">
                             <div class="row">
                    <?php     
                    while ($registro2 = $resultados2->fetch_object()) {
						?>
                        <div class="col-md-3">

                        <div class="youtube-player" data-id="<?php echo vid($registro2->url_embed) ?>" data-related="0" data-control="1" data-info="1" 
                                data-fullscreen="1" >
                                <div class="embed-responsive embed-responsive-16by">
                            <div class="definition">
                            <img src="//i.ytimg.com/vi/<?php echo vid($registro2->url_embed) ?>/hqdefault.jpg"> 
                            <div style="height: 72px; width: 72px; left: 50%; top: 50%; margin-left: -36px; margin-top: -36px; position: absolute; background: url('http://i.imgur.com/TxzC70f.png') no-repeat;"></div>
                            </div>
                            
                            </div>
                            </div>

                            
                                
                                    
                                    <label class=" "><?php echo $registro2->titulo; ?> </label> 

                                    <form method="post" action="league.php?acao=avaliar&cod_videos=<?php echo $registro2->cod_videos; ?>">
                                        <div class="input-group input-group-sm min2 " >
                                                <div class="input-group-prepend" style="min-width: 100%"> 
                                                    <?php if(($objRating->Media($registro2->cod_videos)) == false) {  
                                                        ?>                              
                                                        <span class="input-group-text  form-control-sm" style="min-width: 100%;"><div style="margin-left: auto; margin-right: auto;"> 
                                                    
                                                        <?php
                                                        echo "N/A";
                                                        ?>
                                                        
                                                    </div>
                                                        </span>
                                                        <?php
                                                    }else {                                          
                                                        ?>
                                                        
                                                         <span class=" mb-3 input-group-text form-control-sm min2 " style="min-width: 100%;"><div style="margin-left: auto; margin-right: auto;"><?php echo $objRating->Media($registro2->cod_videos);?></div></span>
                                                    
                                                        <?php
                                                    }?>
                                                </div>
                                                </div>
                                                
                                                
                                                </form>
                                                                                 
                </div>
            
<?php
} 
    ?>
    

<?php

} 
    ?>

            </div>
        </div>
            <?php

        if(isset($_GET["msg"])){
            if($_GET["msg"] == "success") {
            ?>
                <script>
                Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: 'Troca de senha efetuada!',
           
            })
                </script>

            <?php
            }
            if($_GET["msg"] == "inserido") {
                ?>
                <script>
                Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: 'Vídeo compartilhado!',
           
            })
                </script>
                <?php
            }
            if($_GET["msg"] == "alreadyshared") {
                ?>
                <script>
                Swal.fire({
            icon: 'error',
            title: 'Algo deu errado!',
            text: 'Este vídeo já foi compartilhado!',
           
            })
                </script>
                <?php
            }

        }
        ?>

        <script>
 


            function mostrarSenha(){
            var x = document.getElementById("myInput");


            if (x.type === "password") {
            x.type = "text";
            } else {
            x.type = "password";
            }
            }



        </script>

<script> (function() { var v = document.getElementsByClassName("youtube-player"); 
for (var n = 0; n < v.length; n++) { 
   v[n].onclick = function () { 
      var iframe = document.createElement("iframe"); 
      iframe.setAttribute("src", "//www.youtube.com/embed/" + this.dataset.id + "?autoplay=1&autohide=2&border=0&wmode=opaque&enablejsapi=1&rel="+ this.dataset.related +"&controls="+this.dataset.control+"&showinfo=" + this.dataset.info);
       iframe.setAttribute("frameborder", "0"); 
       iframe.setAttribute("id", "youtube-iframe"); 
       iframe.setAttribute("style", "width: 100%; height: 215px; position: relative; top: 0; left: 0;"); 
       
       if (this.dataset.fullscreen == 1){ 
         iframe.setAttribute("allowfullscreen", ""); } 
         while (this.firstChild) { 
            this.removeChild(this.firstChild); }
             this.appendChild(iframe); }; } })(); 


  

</script>
        </body>



    
