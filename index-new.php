<?php
    include_once("includes/cabecalho.php");
    require_once("BD/conecta.php");

    $query_filme = "Select * from Filmes Order By Fil_Lancamento Limit 5";
    $res_filme = mysqli_query($dbc, $query_filme);

    $pos = 0;
?>	

    
        <div class="row">
            <div class="col-md-12"> 
            

                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="height:100%">

                    <ol class="carousel-indicators">
                    <?php while($filme = mysqli_fetch_assoc($res_filme)){ ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?= $pos?>" class="<?php if($pos == 0){echo 'active'; $pos++;}?>"></li>
                    <?php } ?>
                    </ol>
                    <div class="carousel-inner" >
                    <?php while($filme = mysqli_fetch_assoc($res_filme)){ ?>
                        <div class="carousel-item <?php if($pos == 0)echo 'active';?>">
                            <img class="d-block w-100" src="<?= $filme['Fil_Wallpaper']; ?>" alt="Slide">
                            <div class="carousel-caption d-none d-md-block rounded" style="background-color: rgba(0, 0, 0, 0.7)">
                                <h5><?= $filme['Fil_Titulo']; ?></h5>
                                <p><?= $filme['Fil_Sinopse']; ?></p>
                            </div>
                        </div>
                    <?php }?> 
                                           
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    </div>

            </div>
        </div>
    

<?php 
include_once("includes/rodape.php"); ?>
