<?php

include "topo.php";
include "include/conecta.php";
include "classes/rating.php";
include "classes/usuario.php";
include "classes/videos.php";
include "classes/comments.php";

$_SESSION["document"] = "league.php";

$objComment = new Comments($bd_conn);

$objUser = new Usuario($bd_conn);

$objRating = new Rating($bd_conn);

$objVideos = new Videos($bd_conn);


if(isset($_GET["acao"])){

    if (($_GET["acao"]) == "avaliar") {
        $vd = $_GET["cod_videos"];
        $usuario = $_SESSION["autenticado_usuario"];
        $cod = $objUser->PegarCod($usuario);
        if(isset($_POST["cat1"])) {
        $nota = $_POST["cat1"];

        if(($nota < 0) or ($nota > 10)) {
            ?>
            <script>
            Swal.fire({
        icon: 'error',
        title: 'Algo deu errado!',
        text: 'Nota fora do intervalo exigido!',
       
              })
            </script>

            <?php
        }else {
    
        $objRating->setNota($nota);
        $objRating->setCod($cod);
        $objRating->setCod_Vid($vd);
        $objRating->Inserir();

        $result = $objRating->Media($_GET["cod_videos"]);
        
        $objVideos->setMedia($result);
        $objVideos->setCod_videos($vd);

        $objVideos->Atualizar();

        header("location: league.php");
    }

        }
    }
                
    else if(($_GET["acao"]) == "comentar"){

        $user = $_SESSION["autenticado_usuario"];

        $cod = $objUser->PegarCod($user);
    
            $coment = $_POST["comment"];
          
            $userid = $_SESSION["cod"];
    
            
    
            date_default_timezone_set('America/Sao_Paulo');
            $date = date('Y-m-d H:i');
            
            
            $objComment->setComentario($coment);
            $objComment->setCod_video($userid);
            $objComment->SetQuando($date);
            $objComment->SetUserID($cod);
            $objComment->inserir();

            ?>



                <script>
                    $(document).ready(function(){
                        $(function(){
                    var userid = "<?php echo $_SESSION['cod'];?>" 
                    $.ajax({
                        url: 'ajaxfile.php',
                        type: 'post',
                        data: {userid: userid},
                        success: function(response){ 
                            $('.modal-body1').html(response);
                            $('#empModal').modal({'show' : true});
                            
                        }
                    });
                });
            });

                </script>

<?php
    
            
    
    
            
           
    
        }
    
    
    
}





?>


<body>
    
    <style>
        .min {
            
            min-width: 81%;
            

        }
        .max {
            min-width: 60%;
            
        }
 

    img{
        width: 100%;
        height: 215px;
        
    }

   
 


    </style>

    <?php
        function vid($url){
            $video_url = trim($url);
            $params = parse_url($video_url);

            parse_str($params['query'], $query);

            return $query['v'];

        }
    ?>






    <div class="container">
        <div class="row d-flex my-4  ">
        <?php
					include "include/conecta.php";
					$sql = "select cod_videos, url_embed, categoria, titulo, media, cod_usuario from videos where categoria = 'League of Legends' order by media desc, cod_videos asc";
                    
					$consulta = $bd_conn->query($sql);
                    
                    while ($registro = $consulta->fetch_object()) {
                        
                        
						?>
                        <div class="col-md-6 col-lg-4 col-sm-12 col-xs-8 " >

                      
                            

                            
                            <div class="youtube-player" data-id="<?php echo vid($registro->url_embed) ?>" data-related="0" data-control="1" data-info="1" 
                                data-fullscreen="1" >
                                <div class="embed-responsive embed-responsive-16by ">
                            <div class="definition">
                            <img src="//i.ytimg.com/vi/<?php echo vid($registro->url_embed) ?>/hqdefault.jpg"> 
                            <div style="height: 72px; width: 72px; left: 50%; top: 50%; margin-left: -36px; margin-top: -36px; position: absolute; background: url('http://i.imgur.com/TxzC70f.png') no-repeat;"></div>
                            </div>
                            
                            </div>
                            </div>

                            
                                
                            <div class="row ">
                                <div class="col-md-12">
                                    <label class="mt-1"><?php echo $registro->titulo; ?> </label>
                                    </div>
                                    </div>

 
                                  
                                    <div class="row mb-4" >
                                        <div class="col-md-12" >

                                    <form method="post" action="league.php?acao=avaliar&cod_videos=<?php echo $registro->cod_videos; ?>">
                                       
                                    <div class="input-group input-group-sm mb-3" >

                                   
                                                
                                                <div class="input-group-prepend">
                                                <?php 
                                                    if(($objRating->Media($registro->cod_videos)) == false) {  
                                                        ?>    
                                            
                                                <span class="input-group-text " style="min-width: 50px; "><div style="margin-left: auto; margin-right: auto;">N/A</div></span>
                                                
                                                <?php
                                                    } else {
                                                                            ?>
                                                        
                                                        <span class="input-group-text " style="min-width: 50px; "> <div style="margin-left: auto; margin-right: auto;"><?php echo $objRating->Media($registro->cod_videos);?></div></span>
                                                        
                                                        
                                                        <?PHP
                                                    }
                                                    ?>
                                                    </div>
                                                    <?php     
                                        if (isset($_SESSION["autenticado_usuario"])){

                                            $user = $_SESSION["autenticado_usuario"];

                                            $cod = $objUser->PegarCod($user);

                                            if($cod != $registro->cod_usuario) {                             
                                                if($objRating->PegarCodVid($registro->cod_videos, $cod) > 0){
                                                    
                                                ?>
                                                    
                                                    <input type="text" class="form-control form-control-sm text-center" disabled placeholder="Você já avaliou este vídeo.">

                                                    
                                              
                                                    <?php
                                                    
                                                
                                                }
                                                else {
                                                ?>

                                                    <input type="text" class="form-control text-center" name="cat1" placeholder="Nota(1-10)" required autofocus>
                                                    
                                                    <div class="input-group-append">
                                    
                                                          <button type="submit" class="btn btn-dark " >Avaliar</button>

                                    
                                        
                                                     </div>
                                                     <?php
                                                                }
                                                            }
                                                            else {
                                                                ?>
                                                                    
                                                                    <input type="text" class="form-control text-center" disabled placeholder="Meu vídeo.">

                                                                    
                      
                                                                    <?php
                                                            
                                                        }  
                                                  
                                                        ?>

                                                    <?php
                                             } else {
                                                ?>
                                    
                                        
                                                    
                                                    <input type="text" class="form-control text-center" disabled placeholder="É necessario login">

                                                                
                                                                    
                                                    <?php } ?>

                                                    <div class="input-group-append">
                                                        
                                                        <button  type="button" data-id='<?php echo $registro->cod_videos; ?>'  class="userinfo btn btn-primary btn-sm"><i class="fa-regular fa-comments"></i></button>
                                                    
                                                             </div>
                                                            
                                            

                                            </div>
                                        </form>

                                
                                        </div>
                                        </div>
                                        
                                    
                                        
                                
                        </div>
                    <?php
                        }
                                            
                                                ?>                            
                                             
      

<body>


<div  class="modal fade" id="empModal" role="dialog">
                <div class="modal-dialog" style="min-width: 500px;">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title w-100">Comentários</h4>
                          <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body1">

                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">fechar</button>
                        </div>
                    </div>
                </div>
        </div>


<script type='text/javascript'>

$(document).ready(function(){
                $('.userinfo').click(function(){
                    var userid = $(this).data('id');    
                    $.ajax({
                        url: 'ajaxfile.php',
                        type: 'post',
                        data: {userid: userid},
                        success: function(response){ 
                            $('.modal-body1').html(response);
                            $('#empModal').modal({'show' : true});
                            
                        }
                    });
                });
            });

</script>


<script> (function() { var v = document.getElementsByClassName("youtube-player"); 
for (var n = 0; n < v.length; n++) { 
   v[n].onclick = function () { 
      var iframe = document.createElement("iframe"); 
      iframe.setAttribute("src", "//www.youtube.com/embed/" + this.dataset.id + "?autoplay=1&autohide=2&border=0&wmode=opaque&enablejsapi=1&rel="+ this.dataset.related +"&controls="+this.dataset.control+"&showinfo=" + this.dataset.info);
       iframe.setAttribute("frameborder", "0"); 
       iframe.setAttribute("id", "youtube-iframe"); 
       iframe.setAttribute("style", "width: 100%; height: 215px; position: relative; top: 0; left: 0; display: block;"); 
       iframe.setAttribute("class", "embed-responsive-item ");
       if (this.dataset.fullscreen == 1){ 
         iframe.setAttribute("allowfullscreen", ""); } 
         while (this.firstChild) { 
            this.removeChild(this.firstChild); }
             this.appendChild(iframe); }; } })(); 


  

</script>



<?php

include "modal.php";

?>