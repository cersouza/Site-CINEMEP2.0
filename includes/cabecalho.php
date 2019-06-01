<?php
  //Setando configurações de data
  setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
  date_default_timezone_set('America/Sao_Paulo');

  $usu_id = -1;
  $usu_perfil = 0;
  
  session_start();

  if(isset($_SESSION['usu_id'])){  
    $usu_id = $_SESSION['usu_id'];
    $usu_nome = $_SESSION['usu_nome'];
    $usu_perfil = $_SESSION['usu_perfil'];
  }

  if ($usu_id == -1){
    session_unset();
    session_destroy();
  }

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap 4.0 CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!-- CSS Interno -->
    <link rel="stylesheet" href="css/estilos.css" />

    <title><?php if(isset($titulo_pagina)) echo $titulo_pagina . " - CINEMEP";
                  else echo "CINEMEP"; ?></title>
    <link rel="shortcut icon" href="img/icon_amarelo.png" />

  </head>
  <body>
    <header>
      <!-- sticky-top : classe que faz com que o elemento faça parte do fluxo comum da Page e fique fixo ao topo - CERSZ -->
      <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <a class="navbar-brand" href="index.php"><img class="d-inline-block align-top" src="img/icon_amarelo.png" width="30" height="30"> CINEMEP</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navgation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarNav">         
          
            
            <ul class="navbar-nav d-flex align-items-center">  

              <li clss="nav-item active">
                <a class="nav-link" href="index.php">HOME</span></a>
              </li>
              <li clss="nav-item">
                <a class="nav-link" href="lista-filmes.php">FILMES</span></a>
              </li>

              <?php if($usu_perfil == 3) {?>
              <li clss="nav-item">
                <a class="nav-link" href="dashboard.php">Administrativo</span></a>
              </li>
              <?php } ?>

              <?php if($usu_id > -1){ ?>

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="opcoes_login" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Olá <?= $usu_nome;?>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="opcoes_login">
                      <a class="dropdown-item" href="alt-cadastro.php">Alterar Conta</a>
                      <hr />
                      <a class="dropdown-item" href="BD/deslogar.php">Sair</a>                      
                  </div>
                </li>
              
              <?php } else {  ?> 
                <li clss="nav-item">
                    <a class='nav-link' href='login.php'><button class='btn btn-light text-dark'>LOGAR</button></a>
                </li>
                <li clss="nav-item">
                    <a class='nav-link' href='cadastro.php'>CADASTRAR-SE</a>
                </li>
              <?php } ?>            
              
            </ul>

          </div> 
        </div>
      </nav>
    </header>
