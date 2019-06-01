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
		
        $erros = array();
		if (empty($_POST['Fil_Titulo'])) {
	        $erros[] = 'Você esqueceu de digitar um título.';
		} else {
			$titulo = mysqli_real_escape_string($dbc, trim($_POST['Fil_Titulo']));
        }

        if (empty($_POST['fil_sinopse'])) {
	        $erros[] = 'Você esqueceu de digitar uma sinopse.';
		} else {
			$sinopse = mysqli_real_escape_string($dbc, trim($_POST['fil_sinopse']));
        }

        if (empty($_POST['fil_lancamento'])) {
	        $erros[] = 'Você esqueceu de digitar uma data de lançamento.';
		} else {
            $lancamento = mysqli_real_escape_string($dbc, trim($_POST['fil_lancamento']));
            $lancamento = date("Y-m-d", strtotime($lancamento));
        }

        if (empty($_POST['fil_tempo'])) {
	        $erros[] = 'Você esqueceu de digitar o tempo do filme.';
		} else {
			$tempo = mysqli_real_escape_string($dbc, trim($_POST['fil_tempo']));
        }

        if (empty($_POST['fil_genero'])) {
	        $erros[] = 'Você esqueceu de digitar um genero.';
		} else {
			$genero = mysqli_real_escape_string($dbc, trim($_POST['fil_genero']));
        }

        if (empty($_POST['fil_classificacao'])) {
	        $erros[] = 'Você esqueceu de digitar uma classificação.';
		} else {
			$classificacao = mysqli_real_escape_string($dbc, trim($_POST['fil_classificacao']));
        }

        if (empty($_POST['fil_distribuidora'])) {
	        $erros[] = 'Você esqueceu de digitar uma distribuidora.';
		} else {
			$distribuidora = mysqli_real_escape_string($dbc, trim($_POST['fil_distribuidora']));
        }

        if (empty($_POST['fil_url'])) {
	        $url = '';
		} else {
			$url = mysqli_real_escape_string($dbc, trim($_POST['fil_url']));
        }

        $location = 'img/Cartaz/';

        $isfoto = false;
        if (isset($_FILES['foto'])) {
            if ($_FILES['foto']['tmp_name'] != '') {               
            
                $tmp_name = $_FILES['foto']['tmp_name'];

                if (empty($_POST['Fil_Titulo'])) {
                    $name = $_FILES['foto']['name'];
                } else {
                    $name = $_POST['Fil_Titulo'] . '.' . pathinfo($tmp_name, PATHINFO_EXTENSION);                 
                }

                $error = $_FILES['foto']['error'];
                if ($error !== UPLOAD_ERR_OK) {
                    echo 'Erro ao fazer o upload: '. $error;
                } else { 
                    move_uploaded_file($tmp_name, $location . $name);
                }

                $novoDestino = $location . $name;
                $isfoto = true;
            }
        }

        $isWall = false;
        if (isset($_FILES['wall'])) {
            if ($_FILES['wall']['tmp_name'] != '') {
                $locationwall = 'img/wallpaper/';

                $tmp_namewall = $_FILES['wall']['tmp_name'];

                if (empty($_POST['Fil_Titulo'])) {
                    $namewall = $_FILES['wall']['name'];
                } else {
                    $namewall = $_POST['Fil_Titulo'] . '1.png';                 
                }

                $error = $_FILES['wall']['error'];
                if ($error !== UPLOAD_ERR_OK) {
                    $erros[] =  'Erro ao fazer o upload: '. $error;
                } else { 
                    move_uploaded_file($tmp_namewall, $locationwall . $namewall);
                }

                $destinoWall = $locationwall . $namewall;
                $isWall = true;
            }
        }

        //Verifica se há erros
		if (empty($erros)) {

            //SQL de alteração
            $q = "UPDATE FILMES SET Fil_Titulo='$titulo',Fil_Sinopse='$sinopse'";
            if ($isfoto == true){
                $q = $q . ",Fil_Foto='$novoDestino'";
            }
            if ($isWall == true){
                $q = $q . ",Fil_wall='$destinoWall'";                
            }
            $q = $q . ",Fil_Lancamento='$lancamento',Fil_Tempo='$tempo',Fil_Genero=$genero,
                        Fil_Classificacao=$classificacao,Fil_Distribuidora=$distribuidora,
                        Fil_Situacao='Ativo',fil_url='$url' WHERE fil_codigo = $id";	
            
            $r = @mysqli_query($dbc, $q);
			if ($r) {
			    $sucesso = "<h1><strong>Sucesso!</strong></h1>
			    <p>Seu registro foi alterado com sucesso!</p>
			    <p>Aguarde... Redirecionando!</p>";
		     	echo "<meta HTTP-EQUIV='refresh' 
                CONTENT='3;URL=dashboard.php?tb=filme&op=menu'>";
		    } else {
		 		$erro = "<h1><strong>Erro no Sistema</strong></h1>
				<p>Você não pode alterar o registro devido a um 
				erro no sistema.
				Pedimos desculpas por qualquer inconveniente.</p>";				
			}
		} else {
			$erro = "<h1><strong>Erro!</strong></h1>
			    <p>Ocorreram o(s) seguinte(s) erro(s): <br />";
			    foreach ($erros as $msg)
			    {
				   $erro .= "- $msg <br />";
			    }
			    $erro .= "</p><p>Por favor tente novamente.</p>";
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
    <h1 class="page-header">Alteração de Filme</h1>
			
	<?php
		if	(isset($erro))
			echo "<div class='alert alert-danger'>$erro</div>";
			
		if	(isset($sucesso))
			echo "<div class='alert alert-success'>$sucesso</div>";
    ?>

        <form enctype="multipart/form-data" method="post" action="dashboard.php?tb=filme&op=alt">
			
            <div id="actions" align="right">
                <a class="btn btn-default" href="dashboard.php?tb=filme&op=menu">Voltar Página Anterior</a>
                <input type="submit" class="btn btn-warning" value="Salvar Alteração" />
            </div>
                    
            <div class="row">
                <div class="form-group col-md-12">
    
                    <label>Título</label>
                    <input type="text" name="Fil_Titulo" maxlength="50" class="form-control"
                        placeholder="Digite um título" value="<?php echo $row[1]; ?>"/>
    
                    <br/>
                    <label>Sinopse</label>
                    <br/>
                    <textarea id="fil_sinopse" name="fil_sinopse" rows="3" cols="60"><?php echo $row[2]; ?>
                    </textarea>
                    <br/>
    
                    <label>Cartaz</label>   
                    <input type="file" name="foto" class="form-control" 
                        accept=".jpeg,.jpg,.gif,.png,.bitmap"/>   
    
                    <div class="row">
                        <div class="col-md-3">
                            <label>Data Lançamento</label>
                            <input type="date" name="fil_lancamento" maxlength="50" class="form-control"
                                data-date-format="DD MM YYYY" 
                                placeholder="Digite uma data de lançamento." value="<?php echo $row[4]; ?>"/>
                        </div>
    
                        <div class="col-md-6">
                        </div>
    
                        <div class="col-md-3">
                            <label>Tempo de filme</label>
                            <input type="text" name="fil_tempo" maxlength="6" class="form-control"
                                placeholder="Digite o tempo do filme" value="<?php echo $row[5]; ?>"/>
                        </div>
                    </div> 
    
                    <label>Genero</label>
                    <select name="fil_genero" id="fil_genero" class="form-control w-3">                    
                        <?php
    
                            $gnr = "select gen_codigo,gen_descricao from genero";
                            
                            $rg = @mysqli_query($dbc, $gnr);            
                            while($row =  mysqli_fetch_array($rg, MYSQLI_ASSOC)) {
                                echo '<option value="' .$row['gen_codigo']. '"> ' .$row['gen_descricao']. ' </option>';
                            }
                        ?>
                    </select>
                                    
                    <label>Classificacao</label>
                    <select name="fil_classificacao" id="fil_classificacao" class="form-control w-3">                
                        <?php
                            
    
                            $clssccc = "select cla_codigo,cla_descricao from classificacao";
    
                            $rc = @mysqli_query($dbc, $clssccc);
                            while($row2 = mysqli_fetch_array($rc,MYSQLI_ASSOC)) {
                                echo '<option value="' .$row2['cla_codigo']. '"> '. $row2['cla_descricao'] .' </option>';
                            }
                        ?>     
                    </select>    
                                    
                    <label>Distribuidora</label>
                    <select name="fil_distribuidora" id="fil_distribuidora" class="form-control w-3">                
                        <?php 
                            
    
                            $dstrbdr = "select dis_codigo,dis_nomefantasia from distribuidora";
                            
                            $rds = @mysqli_query($dbc, $dstrbdr);
                            while($r3 = mysqli_fetch_array($rds,MYSQLI_ASSOC)) {
                                echo '<option value="' . $r3['dis_codigo'] . '"> ' . $r3['dis_nomefantasia'] . ' </option>';
                            }
                        ?>
                    </select>

                    <label>WallPaper</label>
                    <input type="file" name="wall" class="form-control" 
                        accept=".png"/> 
                    
                    <label>URL</label>
                    <input type="url" name="fil_url" id="fil_url" class="form-control"
                        placeholder="Digite a url" value="<?php $row[11] ?>"/>
                
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