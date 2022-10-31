<?php
include "topo.php";
?>


  <head>
   
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/0f9d48751c.js" crossorigin="anonymous"></script>


   
    <title>Fazer login no sistema</title>

    </head>

    <body>
        <div class="container margin my-3">
            <div class="row align-items-center">
                <div class="col-md-10 mx-auto col-lg-5">
                    <div class="card">
                        <div class="card-header login-size">
                            Login
                        </div>
                        <div class="card-body">
                            <form method="post" action="validarlogin.php">
                                <div class="form-floating mb-3 input-group">
                                    <div class="input-group-prepend">
                                        <span class=input-group-text><i class="fa fa-user"></i></span>
                                    </div>
                                     <input type="text" id="edUsuario" name="edUsuario" class="form-control" placeholder="Seu usuário" required autofocus>   
                                 </div>
                                 <div class="form-floating mb-3 input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                                    </div>
                                     <input type="password" id="edSenha" name="edSenha" class="form-control" placeholder="Senha" required>
                                 </div>
                                     <button class="btn btn-lg btn-success btn-widght" type="submit">Entrar</button>
                            </form>
                         </div>    
                        <?php
                        if(isset($_GET['msg'])) {
                            $mensagem = 'Login inválido';
                         ?>   
                            <div class="card-footer text-center login-sizes"><?php echo $mensagem; ?></div>
                        <?php
                        }  
                        ?>
                    </div>           
                </div>    
            </div>

<?php
include "footer.php";
?>