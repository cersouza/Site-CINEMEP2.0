<?php include_once("includes/cabecalho.php"); 
    include_once("BD/conecta.php");?>	
    
    <div class="row">
        <div class="col-md-12"> 
            
            <div class="card bg-light">
                <div class="card-header text-primary"><h3 class="card-title text-capitalize">Filmes disponíveis</h3></div>
                    <div class="card-body">

                        <div class="card-group bg-light">

                        <?php 
                            //info Filme
                            $query_filme = "Select F.*, G.Gen_Descricao, C.Cla_Codigo
                                                from Filmes F
                                                inner join Genero G on (F.Fil_Genero = G.Gen_Codigo)
                                                inner join Classificacao C on (F.Fil_Classificacao = C.Cla_Codigo)
                                                inner join Distribuidora D on (F.Fil_Distribuidora = D.Dis_Codigo);";

                            $res_filme = mysqli_query($dbc, $query_filme);                            
                            
                            while($filme = mysqli_fetch_assoc($res_filme)){

                                //info Nota
                                $query_nota = "Select AVG(Com_Avaliacao) as 'media_avalicao'
                                from Comentario Where Com_Filme = ".$filme["Fil_Codigo"]."
                                Group by Com_Filme;";
                                
                                if ($res_nota = mysqli_query($dbc, $query_nota)){
                                    $nota_usu = mysqli_fetch_assoc($res_nota);
                                }
                        ?>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img class="rounded" src="<?= $filme["Fil_Foto"];?>" width="auto" height="250">
                                        </div>
                                        <?php date_default_timezone_set("America/Sao_Paulo");?>  
                                        <div class="col-md-8">
                                            <small class="text-small"><?= $filme["Fil_Tempo"] . " / " .$filme["Gen_Descricao"]. " / ". date('d \d\e M\, Y', strtotime($filme["Fil_Lancamento"]));?></small>
                                            <h3 class="card-title"><?= $filme["Fil_Titulo"]." <img src='img/classificacao_".$filme["Cla_Codigo"].".png' style='height:32px; width:auto;'/>";?></h3>
                                            <p class="card-text"><?= $filme["Fil_Sinopse"];?></p>
                                            <p class="card-text text-warning">
                                                <?php 
                                                    if ($nota_usu["media_avalicao"] != 0){
                                                        echo "<strong>Nota:</strong>";
                                                    $nota_filme = round($nota_usu["media_avalicao"], 0);

                                                        for($i = 0; $i < $nota_filme; $i++){
                                                                echo "<img src='img/star.png' style='height:24px; width:auto;'/>";
                                                        }                                                         
                                                }else{
                                                    echo "<strong>Ainda não Avaliado!</strong>";
                                                }


                                                ?>
                                                <br /><br />
                                                <a href="filme.php?id=<?= $filme["Fil_Codigo"];?>"><button class="btn btn-primary">Ver Mais!</button></a>
                                            </p>            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>                            
                            
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>    

<?php include_once("includes/rodape.php"); ?>
