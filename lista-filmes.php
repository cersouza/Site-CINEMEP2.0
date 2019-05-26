<?php
include_once("includes/cabecalho.php"); 
include_once("BD/conecta.php");

if(isset($_GET['gen'])){
    $gen = $_GET['gen'];
}
if(isset($_GET['ord'])){
    $ord = $_GET['ord'];
}

?>	
    
    <div class="row">
        <div class="col-md-12"> 
            <nav class="navbar navbar-light navbar-expand-lg bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#opcoes-lista-filmes" aria-controls="opcoes-lista-filmes" aria-expanded="false" aria-label="Opções de Pesquisa">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="opcoes-lista-filmes">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?= (!(isset($gen)))? 'active':''; ?>" href="lista-filmes.php">Todos</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#opcoes-class" role="button" aria-expanded="false" aria-controls="opcoes-class">
                            Gêneros
                        <div class="collapse" id="opcoes-class">
                        <div class="d-flex">                        
                        <?php 
                            //$query_generos = "Select G.* From Genero G Inner Join Filmes F On (G.Gen_Codigo = F.Fil_Genero) Group By G.Gen_Codigo Order By Gen_Descricao;";
                            $query_generos = "Select * From Genero Order By Gen_Descricao;";

                            $res_generos = mysqli_query($dbc, $query_generos);  

                            while($generos = mysqli_fetch_assoc($res_generos)){
                        ?>  
                            <?php 
                            $q_gen_filme = "Select Count(Fil_Codigo) as 'qtd_fil' From Filmes Where Fil_Genero = ".$generos['Gen_Codigo'];
                            
                            $res_gen_filme = mysqli_query($dbc, $q_gen_filme);

                            $gen_filme = mysqli_fetch_assoc($res_gen_filme);

                            if(isset($gen)) if($gen == $generos['Gen_Descricao']) $titulo = $generos['Gen_Descricao'];
                                
                            ?>                         
                            <a class="nav-link <?= ($gen == $generos['Gen_Descricao'])? 'active':''; ?>" href="lista-filmes.php?gen=<?= $generos['Gen_Descricao'];?>"><?= $generos['Gen_Descricao']." (".$gen_filme['qtd_fil'].")";?></a>                            
                        <?php } ?>
                        </div>
                        </div>
                        </li>

                        <li class="nav-item mx-2">
                            <div class="dropdown show">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Ordenar
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <!--a class="dropdown-item" href="#">Melhores Avaliados</a>
                                    <a class="dropdown-item" href="#">Menos Avaliados</a -->
                                    <a class="dropdown-item" href="lista-filmes.php?ord=data DESC">Mais Recentes</a>
                                    <a class="dropdown-item" href="lista-filmes.php?ord=data ASC">Mais Antigos</a>
                                    <a class="dropdown-item" href="lista-filmes.php?ord=til ASC">Nome (A-Z)</a>
                                    <a class="dropdown-item" href="lista-filmes.php?ord=til DESC">Nome (Z-A)</a>
                                </div>
                            </div>
                        </li>

                        

                        <form class="form-inline" method="GET" action="lista-filmes.php">
                            <input class="form-control mr-sm-2" type="search" name="q" placeholder="Pesquisar Filme" aria-label="Pesquisar">
                            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Pesquisar</button>
                        </form>
                    </ul>
                </div>
            </nav>   
                    
            <div class="card bg-light">
                <div class="card-header text-primary"><h3 class="card-title text-capitalize"><?= (isset($gen))? $titulo:'Ver todos os filmes'?></h3></div>
                    <div class="card-body">

                        <div class="card-column bg-light">

                        <?php 
                            //info Filme
                            $query_filme = "Select F.*, G.Gen_Descricao, C.Cla_Codigo
                                                from Filmes F
                                                inner join Genero G on (F.Fil_Genero = G.Gen_Codigo)
                                                inner join Classificacao C on (F.Fil_Classificacao = C.Cla_Codigo)
                                                inner join Distribuidora D on (F.Fil_Distribuidora = D.Dis_Codigo)";
                            if((isset($gen)) && ($gen != "")) $query_filme .= " Where G.Gen_Descricao = '$gen'";
                            
                            
                            
                            
                            if(isset($_GET["q"]))
                            {
                            $qtitulo = $_GET["q"];
                            if ($qtitulo != "") $query_filme .= " Where F.Fil_Titulo Like '%$qtitulo%' ";
                            }

                            //Ordenando a Query
                            if((isset($ord)) && ($ord != "")){
                                
                                $q_ord = "";
                                
                                switch ($ord){
                                    case "til ASC": $q_ord = "F.Fil_Titulo ASC";
                                        break;
                                    case "til DESC": $q_ord = "F.Fil_Titulo DESC";
                                        break;  
                                    case "data ASC": $q_ord = "F.Fil_Lancamento ASC";
                                        break;
                                    case "data DESC": $q_ord = "F.Fil_Lancamento DESC";
                                        break;
                                }                        
                                
                                $query_filme .= " Order By $q_ord";  
                            } 

                            $res_filme = mysqli_query($dbc, $query_filme);                            
                            
                            if(mysqli_num_rows($res_filme) > 0){

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
                                        <div class="col-md-2 d-flex align-items-center">
                                            <img class="rounded" src="<?= $filme["Fil_Foto"];?>" width="auto" height="250">
                                        </div>
                                        <?php date_default_timezone_set("America/Sao_Paulo");?>  
                                        <div class="col-md-10">
                                            <small class="text-small"><?= $filme["Fil_Tempo"] . " / <a href=lista-filmes.php?gen=".$filme['Gen_Descricao'].">".$filme["Gen_Descricao"]. "</a> / ". date('d \d\e M\, Y', strtotime($filme["Fil_Lancamento"]));?></small>
                                            <h3 class="card-title text-uppercase"><?= $filme["Fil_Titulo"]." <img src='img/classificacao_".$filme["Cla_Codigo"].".png' style='height:32px; width:auto;'/>";?></h3>
                                            <p class="card-text"><?= $filme["Fil_Sinopse"];?></p>
                                            <p class="card-text text-warning">
                                                <?php 
                                                    if ($nota_usu["media_avalicao"] != 0){
                                                        $nota_star = "<div class='container p-0 m-0 text-warning'> <strong>Nota: </strong>";
                                                    $nota_filme = round($nota_usu["media_avalicao"], 0);

                                                        for($i = 0; $i < $nota_filme; $i++){
                                                            $nota_star .= "<img src='img/star.png' style='height:24px; width:auto;'/>";
                                                        }
                                                        
                                                        $nota_star .= "</div>";
                                                        echo $nota_star;
                                                }else{
                                                    echo "<strong>Ainda não Avaliado!</strong>";
                                                }


                                                ?>
                                                <br /><br />
                                                <a href="filme.php?id=<?= $filme["Fil_Codigo"];?>"><button class="btn btn-primary">Ver Mais</button></a>
                                            </p>            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }//fim While
                        }//fim IF
                        else echo "<div class='card'><div class='card-body d-flex justify-content-center'><p class='text-secondary m-0'>Não há filmes cadastrados com o Gênero ou Título informado.</p></div></div></div>" ?>                            
                            
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>    

<?php include_once("includes/rodape.php"); ?>
