<?php 	
	include_once('includes/cabecalho.php');
	
	if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
		$id = $_GET['id'];
	} else if ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
		$id = $_POST['id'];
	} else {
		header("Location: dashboard.php?tb=atorfilme&op=menu");
		exit();
    }
    
    if ((isset($_POST['fil'])) && (is_numeric($_POST['fil']))) {
		$fil = $_POST['fil'];
	}
	require_once('BD/conecta.php');
	
	if (isset($_POST['enviou']))
	{	
		$erros = array();
		
		if (empty($_POST['atfl_atr_codigo'])) {
	        $erros[] = 'Você esqueceu de escolher um ator.';
		} else {
			$ator = mysqli_real_escape_string($dbc, trim($_POST['atfl_atr_codigo']));
        }

        if (empty($_POST['atfl_papel'])) {
	        $erros[] = 'Você esqueceu de digitar um papel.';
		} else {
			$papel = mysqli_real_escape_string($dbc, trim($_POST['atfl_papel']));
        }

        if (empty($_POST['atfl_importancia'])) {
	        $erros[] = 'Você esqueceu de escolher a importância.';
		} else {
			$importancia = mysqli_real_escape_string($dbc, trim($_POST['atfl_importancia']));
        }

		if (empty($erros))
		{
			$q = "update AtorFilme set Atfl_Atr_Codigo = $ator, Atfl_Fil_Codigo=$fil, Atfl_Papel='$papel',Atfl_Importancia = '$importancia'
                 where Atfl_Codigo = $id";
                		
			$r = @mysqli_query($dbc, $q);
			if ($r) {
                $href = "dashboard.php?tb=atorfilme&op=menu&fil=" . $fil;
                $sucesso = "<h1><strong>Sucesso!</strong></h1>
			    <p>Seu registro foi alterado com sucesso!</p>
                <p>Aguarde... Redirecionando!</p>";
                echo "<meta HTTP-EQUIV='refresh' 
                CONTENT='3;URL=$href'>";
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
    
	$q = "SELECT atfl_codigo,atfl_atr_codigo,atfl_fil_codigo,atfl_papel,atfl_importancia FROM AtorFilme WHERE atfl_codigo=$id";
	$r = @mysqli_query($dbc, $q);
	
	if (mysqli_num_rows($r) == 1)
	{
        $row = mysqli_fetch_array($r, MYSQLI_NUM);
        $fil = $row[2];
?>	

<div class="col-sm-9 col-sm-offset-3 col-md-12 col-md-offset-2 main">
    <h1 class="page-header">Alteração de Ator por Filme</h1>
			
	<?php
		if	(isset($erro))
			echo "<div class='alert alert-danger'>$erro</div>";

		if	(isset($sucesso))
			echo "<div class='alert alert-success'>$sucesso</div>";
	?>
	
  <form method="post" action="dashboard.php?tb=atorfilme&op=alt">
			
		<div id="actions" align="right">
        <?php $href = "dashboard.php?tb=atorfilme&op=menu&fil=" . $fil;
			?>
			<a class="btn btn-default" href="<?php echo $href?>">Voltar Página Anterior</a>
				<input type="submit" class="btn btn-warning" value="Salvar Alteração" />
		</div>

		<div class="row">
			<div class="form-group col-md-12">

            <label>Ator</label>
                <select name="atfl_atr_codigo" id="atfl_atr_codigo" class="form-control w-3">                    
                    <?php
                        require_once('BD/conecta.php');

                        $gnr = "select atr_codigo,atr_nome from Ator";
                        
                        $rg = @mysqli_query($dbc, $gnr);            
                        while($rw =  mysqli_fetch_array($rg, MYSQLI_ASSOC)) {
                            echo '<option value="' .$rw['atr_codigo']. '">' .$rw['atr_nome']. '</option>';
                        }
                    ?>
                </select>

                <label>Papel</label>
                <input type="text" name="atfl_papel" maxlength="50" class="form-control"
                    placeholder="Digite o papel do ator" value="<?php echo $row[3]; ?>"/>
                                
                <label>Importância</label>
                <select name="atfl_importancia" id="atfl_importancia" class="form-control w-3">                
					<option value="1">1 - Principal</option>;
                    <option value="2">2 - Vilão Principal</option>;
                    <option value="3">3 - Secondário</option>;
					<option value="3">4 - Figurante</option>;          
                </select>    

                <?php 
                    require_once('BD/conecta.php');

                    $atr = $row[1];                
                    $impor = $row[4];

                    if (!empty($_POST['atfl_atr_codigo'])) {
                        $atr = mysqli_real_escape_string($dbc, trim($_POST['atfl_atr_codigo']));
                    }
            
                    if (!empty($_POST['atfl_importancia'])) {
                        $impor = mysqli_real_escape_string($dbc, trim($_POST['atfl_importancia']));
                    }
                    echo '<script>document.getElementById("atfl_atr_codigo").value = "' . $atr . '";</script>';
                    echo '<script>document.getElementById("atfl_importancia").value = "' . $impor . '";</script>';
                ?>

 	        </div>					
		</div>	

		<input type="hidden" name="enviou" value="True" />
		<input type="hidden" name="id" value="<?php echo $row[0]; ?>" />
        <input type="hidden" name="fil" value="<?php echo $row[2]; ?>" />
	</form> 
	</div>
	</div>
	</div>
		  
<?php 
	}
	mysqli_close($dbc);
	include_once('includes/rodape.php'); 
?>