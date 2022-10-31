<?php
    session_start();
    
    

?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>

    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery-3.6.1.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://kit.fontawesome.com/0f9d48751c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">

    <style>

      .dropdown-menu{
          
          border-width: 20px;
          border: none;
          margin-right: 50px;
          

      }
    </style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container" >
  <a class="navbar-brand" href="index.php">EsportsLearner</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="counter_strike.php">Counter-Strike <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="league.php">League of legends</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link " href="valorant.php">Valorant</a>
      </li>

      <div class="dropdown">
  <button class="btn btn-dark " type="button" data-toggle="dropdown" aria-expanded="false">
  <i class="fa-solid fa-magnifying-glass"></i>
  </button>
  <div class="dropdown-menu drop">

  <form action="search.php" method="POST" role="search" class="form-inline">
          <input style="min-width: 100%; color:black"class="form-control dropdown-item" name="search" type="search" placeholder="Pesquisar" aria-label="Search">
        </form>
        <div>

    </ul>

    
    <ul class="navbar-nav ml-auto">


  



      <?php
        if (isset($_SESSION["autenticado_usuario"])){
          ?>
          <li class="nav-item active dropdown mr-5">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false"  data-display="static" data-reference="parent">
        <?php echo $_SESSION["autenticado_usuario"]; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
          <a class="dropdown-item" href="profile.php">Profile</a>
          <a class="dropdown-item" href="logout.php">Logout</a>
         
        </div>
      </li>
       <?php
        }else{
          ?>
          <li class="nav-item active">
        <a class="nav-link"  href="#" data-toggle="modal" data-target="#ModalLogin">Login</a>
       </li>
      <li class="nav-item active">
        <a class="nav-link">|</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#ModalCadastro">Registrar-se</a>
     </li>
     </ul>
     <?php
        }

      ?>
      

    
    </div>

  </div>
</nav>


