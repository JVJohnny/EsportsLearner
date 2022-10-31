


<div class="modal fade" id="ModalLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header text-center">
        <h2 class="modal-title w-100" id="exampleModalLabel">Login</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                    <form method="post" action="validarlogin.php">
                                <div class="form-floating mb-3 my-1 input-group">
                                    <div class="input-group-prepend">
                                        <span class=input-group-text><i class="fa fa-user-large"></i></span>
                                    </div>
                                     <input type="text" id="edUsuario" name="edUsuario" class="form-control" placeholder="Seu usuário" required autofocus>   
                                 </div>
                                 <div class="form-floating mb-3 input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                                    </div>
                                     <input type="password" id="edSenha" name="edSenha" class="form-control" placeholder="Senha" required>
                                 </div>
                                 <button class="btn btn-lg btn-success btn-widght w-100" type="submit">Entrar</button>
                                 </form>
      </div>

      <?php
      if (isset($_GET["msg"])) {
        if ($_GET["msg"] == "erro_login") {
          

          
          { ?>
          <div class="modal-footer">
          <div class="alert alert-danger w-100 text-center" role="alert">
  Usuário ou senha invalidos!
</div>
      </div>
        <script>
                 $(function(){
                     $('#ModalLogin').modal('show');
                 });
        </script>
<?php         
    }
}
      }
?>

  
    </div>
  </div>
</div>

    <div class="modal fade" id="ModalCadastro" tabindex="-1" aria-labelledby="ModalCadastro" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header text-center">
        <h2 class="modal-title w-100" id="exampleModalLabel">Registrar-se</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                    <form method="post" action="validarregistro.php"> 
                                <div class="form-floating mb-3 input-group">     
                                <div class="input-group-prepend">
                                        <span class=input-group-text><i class="fa-solid fa-pen"></i></span>
                                    </div>                                                          
                                     <input type="text" name="name" class="form-control" placeholder="Nome Completo" required autofocus>   
                                 </div>
                                 <div class="form-floating mb-3 input-group ">  
                                 <div class="input-group-prepend">
                                        <span class=input-group-text><i class="fa-solid fa-envelope"></i></span>
                                    </div>                                 
                                     <input type="text" name="email" class="form-control" placeholder="Email" required>
                                 </div>
                                 <div class="form-floating mb-3 input-group">       
                                 <div class="input-group-prepend">
                                        <span class=input-group-text><i class="fa-solid fa-user-large"></i></span>
                                    </div>                          
                                     <input type="text" name="username" class="form-control" placeholder="Usuário" required>
                                 </div>
                                 <div class="form-floating mb-3 input-group">   
                                 <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                                    </div>                              
                                     <input type="password" name="senha" class="form-control" placeholder="Senha" required>
                                 </div>
                                 <div class="form-floating mb-3 input-group"> 
                                 <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                                    </div>                                
                                     <input type="password" name="senharepeat" class="form-control" placeholder="Repetir Senha" required>
                                 </div>
                                     <button class="btn btn-lg btn-success btn-widght w-100" type="submit">Registrar</button>
                            </form>
      </div>

      <?php
      if (isset($_GET["msg"])) {
        if ($_GET["msg"] == "usuario_errado") {
          

          
           ?>
                <div class="modal-footer">
                <div class="alert alert-danger w-100 text-center" role="alert">
        Este usuário já existe!
        </div>
            </div>
                <script>
                        $(function(){
                            $('#ModalCadastro').modal('show');
                        });
                </script>
        <?php         
            
        } 
        if ($_GET["msg"] == "senha_errada") {
            ?>
            <div class="modal-footer">
                <div class="alert alert-danger w-100 text-center" role="alert">
        As senhas não coincidem!
        </div>
            </div>
                <script>
                        $(function(){
                            $('#ModalCadastro').modal('show');
                        });
                </script>
        <?php         

        
            }
            if ($_GET["msg"] == "sucesso") {
              ?>

            <script>
            Swal.fire({
        icon: 'success',
        title: 'Sucesso!',
        text: 'Cadastro efetuado!',
       
        })
            </script>
            <?php
        }
      }
        ?>



    </div>
  </div>
</div>