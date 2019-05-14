<?php 
$erro = $_GET["erro"];


include_once("includes/cabecalho.php");

    echo "<div class='row'>
    <div class='col-md-12 d-flex justify-content-center align-items-center p-5 h-100'>
        <div class='alert alert-danger'>
            <h3><strong>Ops... Erro!</strong></h3>
            <p>
                <strong>Ocorreu o seguinte erro:</strong><br>
                - $erro
            </p>
        </div>
    </div>
    </div>";

include_once("includes/rodape.php"); 

?>