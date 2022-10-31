<?php
include "topo.php";
include "include/conecta.php";

$_SESSION["document"] = "index.php";



if(isset($_GET["msg"])){
    if ($_GET['msg'] == "search") {
      ?>
             <script>
                Swal.fire({
            icon: 'error',
            title: 'Algo deu errado!',
            text: 'Não à resultados correspondentes a sua pesquisa!',
           
            })
                </script>



      <?php

    }

}
?>

<title>EsportsLearner</title>

<main role="main">
 



<div class="backg2">
<div class="container">
<div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading my-5">Bem Vindo. <span class="text-muted">EsportsLearner.</span></h2>
        <p class="lead">Aqui você encontrar dicas competitivas sobre Counter-Strike, League of Legends e Valorant!.</p>
      </div>
      <div class="col-md-5">
        <img src="img/gamer.jpeg" alt="Pessoa jogando" width="500" height="500" class=" my-5 featurette-image img-fluid mx-auto rounded">
        

      </div>
    </div>
    
    </div>
    </div>

   
 
        
  <div class="backg3">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
            <h2 class="text-center mt-3" style="font-style:italic;">Ranking por vídeos compartilhados</h2>
            <hr>
            </div>
          </div>
        

          <div class="row">

          


          <?php
              
            

              $contador = 1;
              $sql2 = "select profileimg.name, usuarios.usuario, count(videos.cod_usuario) as contador from videos inner join profileimg on profileimg.userid = videos.cod_usuario inner join usuarios on videos.cod_usuario = usuarios.cod_usuario group by videos.cod_usuario order by contador desc";
					$consulta = $bd_conn->query($sql2);
          while ($registro = $consulta->fetch_object()) {
						?>
             <div class="col-md-3">
            <div class="card my-3 mb-3" >
                
                <div class="card-body text-center">
                <img src="img/<?php echo$registro->name; ?>"  class="rounded-circle text-center" style="margin-left: auto; margin-right: auto; min-height: 150px; max-height: 150px; max-width: 150px;" alt="...">
                <hr>
                  
                  <h5 class="card-title">#<?php echo $contador; ?> <?php echo $registro->usuario; ?></h5>
                  
                  <p class="card-text"><?php echo $registro->contador; ?> vídeo(s) compartilhados.</p>
                  
   
                  </div>
                </div>
           
                  </div>

          
               

          <?php
          $contador = $contador + 1;
          if ($contador > 12) break;
                    
                  } 
                  ?>
                  </div>

                      <div class="row">
            <div class="col-md-12">
            <h2 class="text-center mt-3" style="font-style:italic;">Ranking por vídeos avaliados</h2>
            <hr>
                </div>
                </div>
                  <div class="row">

                  
                  <?php
               
                  $contador2 = 1;
                  $sql = "select profileimg.name, usuarios.usuario, count(rating.cod_notas) as contador from rating
                  left join profileimg on profileimg.userid = rating.cod_notas inner join usuarios on rating.cod_notas = usuarios.cod_usuario group by cod_notas order by contador desc";
                  $consulta = $bd_conn->query($sql);
                            while ($registro = $consulta->fetch_object()) {
                    ?>
                <div class="col-md-3">
                <div class="card my-1 mb-5" >
                    
                    <div class="card-body text-center">
                    <img src="img/<?php echo$registro->name; ?>"  class="rounded-circle text-center" style="margin-left: auto; margin-right: auto; min-height: 150px; max-height: 150px; max-width: 150px;" alt="...">
                    <hr>
                      
                      <h5 class="card-title">#<?php echo $contador2; ?> <?php echo $registro->usuario; ?></h5>
                      
                      <p class="card-text"><?php echo $registro->contador; ?> vídeo(s) avaliados.</p>
                      
       
                      </div>
                    </div>
               
                      </div>
                   
    
              <?php
              $contador2 = $contador2 + 1;
              if ($contador2 > 12) break;
                        }
           
                    ?> 
            </div>


      </div>
        </div>
        </div>
    
        <div class="backg">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <a href="counter_strike.php"><img src="img/csgo.png" alt="" style="width: 300px; "></a>
        </div>
        <div class="col-md-4">
          <a href="league.php"><img src="img/League-of-Legends-Logo-2008.png" alt="" style="width: 300px;"></a>
        </div>
        <div class="col-md-4">
          <a href="valorant.php"><img src="img/valorant.png" alt="" style="width: 300px; "></a>
        </div>
        
      </div>
      
   
          </div>
        </div>






    
<?php
include "modal.php";
include "footer.php";
?>