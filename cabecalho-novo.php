<?php
  //Setando configurações de data
  setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
  date_default_timezone_set('America/Sao_Paulo');
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
          
            <!-- Em bootstrap podemos deixar de usar os elementos
            de listas <ul><li>Lista</li><ul> para fazer Menus, podendo criar
            um Navbar apenas usando classes mostrando o que é o navbar-nav e seus nav-item(s)-->
            <div class="navbar-nav">            
              <a class="nav-item active nav-link" href="index.php">HOME <span class="sr-only">(current)</span></a>
              <!-- a class="nav-item nav-link" href="o-software.php">O SOFTWARE</a>
              <a class="nav-item nav-link" href="os-desenvolvedores.php">OS DESENVOLVEDORES</a>
              <a class="nav-item nav-link" href="contato.php">CONTATO</a -->
              <a class="nav-item nav-link" href="contato.php"><button class="btn btn-light text-dark">LOGAR</button></a>
              <a class="nav-item nav-link" href="contato.php">CADASTRAR-SE</a>
              
            </div>

          </div> 
        </div>
      </nav>
    </header>
