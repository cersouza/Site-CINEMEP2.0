<?php 
include_once("includes/cabecalho.php");  
if($usu_perfil < 3){
    header("Location: 401.php");
}else{
?>    
    <div class="row py-2">        
        <div class="col-md-3"> 
            <?php include_once("includes/menu-lateral.php");?>
        </div>

        <div class="col-md-9 d-flex justify-content-center align-items-center"> 
            <?php 
                if((isset($_GET["tb"])) && (isset($_GET["op"]))){

                    $tabela = $_GET["tb"];
                    $operacao = $_GET["op"];        
                    
                    include_once("includes/dashboard-pages/".$tabela."_".$operacao.".php");
                }
                else{
            ?>
            
            <h1>Você está na Área Administrativa</h1>
            <?php } ?>
        </div>
    </div>   
<?php
}
include_once("includes/rodape.php"); 
?>