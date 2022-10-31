<?php
include "topo.php";
?>

  <head>
    <title>Registrar</title>

    </head>

    <body>
        <div class="container margin my-3">
            <div class="row align-items-center">
                <div class="col-md-10 mx-auto col-lg-5">
                    <div class="card">
                        <div class="card-header login-size">
                            Registrar-se
                        </div>
                        <div class="card-body">
                            <form method="post" action="validarregistro.php">
                                <div class="form-floating mb-3 ">                                                               
                                     <input type="text" name="name" class="form-control" placeholder="Nome Completo" required autofocus>   
                                 </div>
                                 <div class="form-floating mb-3 ">                                 
                                     <input type="text" name="email" class="form-control" placeholder="Email" required>
                                 </div>
                                 <div class="form-floating mb-3 ">                                 
                                     <input type="text" name="username" class="form-control" placeholder="Usuário" required>
                                 </div>
                                 <div class="form-floating mb-3 ">                                 
                                     <input type="password" name="senha" class="form-control" placeholder="Senha" required>
                                 </div>
                                 <div class="form-floating mb-3 ">                                 
                                     <input type="password" name="senharepeat" class="form-control" placeholder="Repetir Senha" required>
                                 </div>
                                     <button class="btn btn-lg btn-success btn-widght" type="submit">Registrar</button>
                            </form>
                         </div>    
                        <?php

                        if(isset($_GET['msg'])) {
                            if($_GET['msg'] == 'senha_errada')
                                $mensagem = 'Senhas não coincidem.';
                        }
                        if(isset($_GET['msg'])) {
                            if($_GET['msg'] == 'usuario_errado')
                                $mensagem = 'Este usuário já existe.';
                        
                         ?>   
                            <div class="card-footer text-center login-sizes"><?php echo $mensagem; ?></div>
                        <?php
                        }  
                        ?>
                    </div>           
                </div>    
            </div>
        </div>  

    
<?php
include "footer.php";
?>