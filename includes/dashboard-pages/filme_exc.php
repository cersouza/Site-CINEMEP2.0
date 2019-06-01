<?php 	
	include_once('includes/cabecalho.php');
	
	if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
		$id = $_GET['id'];
	} else if ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
		$id = $_POST['id'];
	} else {
		header("Location: dashboard.php?tb=filme&op=menu");
		exit();
	}
	
	require_once('BD/conecta.php');
	
	if (isset($_POST['enviou']))
	{
        $q = "SELECT Fil_codigo, Fil_Titulo,Fil_Sinopse,Fil_Foto,Fil_Lancamento,Fil_Tempo,Fil_Genero,Fil_Classificacao,
        Fil_Distribuidora,Fil_Situacao,fil_wall,fil_url FROM filmes WHERE fil_codigo=$id";

        $r = @mysqli_query($dbc, $q);
        
        $deletefile = '';
        $deletewall = '';
        if (mysqli_num_rows($r) == 1)
        {
            $row = mysqli_fetch_array($r, MYSQLI_NUM);
            $deletefile = $row[3];
            $deletewall = $row[10];
        }     

        $q = "delete from atorfilme where atfl_fil_codigo = $id";
        $r = @mysqli_query($dbc, $q);
        if ($r) {    
            $q = "delete from filmes where fil_codigo = $id";
            $r = @mysqli_query($dbc, $q);
            if ($r) {
                
                if ($deletefile != '') {
                unlink($deletefile); 
                }
                if ($deletefile != '') {
                    unlink($deletewall); 
                    }

                $sucesso = "<h1><strong>Sucesso!</strong></h1>
                <p>Seu registro foi excluido com sucesso!</p>
                <p>Aguarde... Redirecionando!</p>";
                echo "<meta HTTP-EQUIV='refresh' 
                CONTENT='0;URL=dashboard.php?tb=filme&op=menu'>";
            } else {
                    $erro = "<h1><strong>Erro no Sistema</strong></h1>
                    <p>Você não pode excluir o registro devido a um 
                    erro no sistema.
                    Pedimos desculpas por qualquer inconveniente.</p>";				
            }
        } else {
            $erro = "<h1><strong>Erro no Sistema</strong></h1>
				<p>Você não pode excluir o registro devido a um 
				erro no sistema.
				Pedimos desculpas por qualquer inconveniente.</p>";
        }
    }
    
	$q = "SELECT Fil_codigo, Fil_Titulo,Fil_Sinopse,Fil_Foto,Fil_Lancamento,Fil_Tempo,Fil_Genero,Fil_Classificacao,
    Fil_Distribuidora,Fil_Situacao,fil_wall,fil_url FROM filmes WHERE fil_codigo=$id";

	$r = @mysqli_query($dbc, $q);
	
	if (mysqli_num_rows($r) == 1)
	{
		$row = mysqli_fetch_array($r, MYSQLI_NUM);
?>	

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Exclusão de Filme</h1>
			
	<?php
		if	(isset($erro))
			echo "<div class='alert alert-danger'>$erro</div>";
			
		if	(isset($sucesso))
			echo "<div class='alert alert-success'>$sucesso</div>";
    ?>

        <form enctype="multipart/form-data" method="post" action="dashboard.php?tb=filme&op=exc">
			
            <div id="actions" align="right">
                <a class="btn btn-default" href="dashboard.php?tb=filme&op=menu">Voltar Página Anterior</a>
                    <input type="submit" class="btn btn-danger" value="Excluir" />
            </div>
                    
            <div class="row">
                <div class="form-group col-md-12">
    
                    <label>Título</label>
                    <input type="text" disabled name="Fil_Titulo" maxlength="50" class="form-control"
                        placeholder="Digite um título" value="<?php echo $row[1]; ?>"/>
    
                    <br/>
                    <label>Sinopse</label>
                    <br/>
                    <textarea id="fil_sinopse" disabled name="fil_sinopse" rows="3" cols="60"><?php echo $row[2]; ?>
                    </textarea>
                    <br/>
    
                    <div class="row">
                        <div class="col-md-3">
                            <label>Data Lançamento</label>
                            <input type="date" disabled name="fil_lancamento" maxlength="50" class="form-control"
                                data-date-format="DD MM YYYY" 
                                placeholder="Digite uma data de lançamento." value="<?php echo $row[4]; ?>"/>
                        </div>
    
                        <div class="col-md-6">
                        </div>
    
                        <div class="col-md-3">
                            <label>Tempo de filme</label>
                            <input type="text" disabled name="fil_tempo" maxlength="6" class="form-control"
                                placeholder="Digite o tempo do filme" value="<?php echo $row[5]; ?>"/>
                        </div>
                    </div> 
    
                    <label>Genero</label>
                    <select name="fil_genero" disabled id="fil_genero" class="form-control w-3">                    
                        <?php
    
                            $gnr = "select gen_codigo,gen_descricao from genero";
                            
                            $rg = @mysqli_query($dbc, $gnr);            
                            while($row =  mysqli_fetch_array($rg, MYSQLI_ASSOC)) {
                                echo '<option value="' .$row['gen_codigo']. '"> ' .$row['gen_descricao']. ' </option>';
                            }
                        ?>
                    </select>
                                    
                    <label>Classificacao</label>
                    <select name="fil_classificacao" disabled id="fil_classificacao" class="form-control w-3">                
                        <?php
                            
    
                            $clssccc = "select cla_codigo,cla_descricao from classificacao";
    
                            $rc = @mysqli_query($dbc, $clssccc);
                            while($row2 = mysqli_fetch_array($rc,MYSQLI_ASSOC)) {
                                echo '<option value="' .$row2['cla_codigo']. '"> '. $row2['cla_descricao'] .' </option>';
                            }
                        ?>     
                    </select>    
                                    
                    <label>Distribuidora</label>
                    <select name="fil_distribuidora" disabled id="fil_distribuidora" class="form-control w-3">                
                        <?php 
                            
    
                            $dstrbdr = "select dis_codigo,dis_nomefantasia from distribuidora";
                            
                            $rds = @mysqli_query($dbc, $dstrbdr);
                            while($r3 = mysqli_fetch_array($rds,MYSQLI_ASSOC)) {
                                echo '<option value="' . $r3['dis_codigo'] . '"> ' . $r3['dis_nomefantasia'] . ' </option>';
                            }
                        ?>
                    </select>

                    <label>URL</label>
                    <input type="url" name="fil_url" class="form-control"
                        placeholder="Digite a url" value="<?php $row[11] ?>" disabled/>
                                        
                    <?php 
                        $q = "SELECT Fil_codigo, Fil_Titulo,Fil_Sinopse,Fil_Foto,Fil_Lancamento,Fil_Tempo,Fil_Genero,Fil_Classificacao,
                        Fil_Distribuidora,Fil_Situacao,Fil_wall,fil_url FROM filmes WHERE fil_codigo=$id";
                   
                        $r = @mysqli_query($dbc, $q);
                            
                        if (mysqli_num_rows($r) == 1)
                        {
                            $row = mysqli_fetch_array($r, MYSQLI_NUM);
                            
                            echo '
                            <div class="row">
                                <div class="col-md-4 mt-2 d-flex justify-content-center align-items-center">        
                                    <a>Cartaz atual</a>     
                                </div>

                                <div class="col-md-8 mt-2 d-flex justify-content-center align-items-center">        
                                    <a>WallPaper</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mt-2 d-flex justify-content-center align-items-center">        
                                    <img class="rounded" src="' . $row[3] . '" width="auto" height="400">
                                </div>

                                <div class="col-md-8 mt-2 d-flex justify-content-center align-items-center">        
                                    <img class="rounded" src="' . $row[10] . '" width="auto" height="400">
                                </div>
                            </div>';

                            $gen = $row[6];                
                            $class = $row[7];                
                            $distri = $row[8];
        
                            if (!empty($_POST['fil_genero'])) {
                                $gen = mysqli_real_escape_string($dbc, trim($_POST['fil_genero']));
                            }
                    
                            if (!empty($_POST['fil_classificacao'])) {
                                $class = mysqli_real_escape_string($dbc, trim($_POST['fil_classificacao']));
                            }
                    
                            if (!empty($_POST['fil_distribuidora'])) {
                                $distri = mysqli_real_escape_string($dbc, trim($_POST['fil_distribuidora']));
                            }
        
                            echo '<script>document.getElementById("fil_genero").value = "' . $gen . '";</script>';
                            echo '<script>document.getElementById("fil_classificacao").value = "' . $class . '";</script>';
                            echo '<script>document.getElementById("fil_distribuidora").value = "' . $distri . '";</script>';
                            echo '<script>document.getElementById("fil_url").value = "' . $row[11] . '";</script>';
                        }   
                    ?>			
	        </div>					
		</div>	

		<input type="hidden" name="enviou" value="True" />
		<input type="hidden" name="id" value="<?php echo $row[0]; ?>" />
	</form> 
	</div>
    </div>
    </div>	  
<?php 
	}
	mysqli_close($dbc);
	include_once('includes/rodape.php'); 
?>