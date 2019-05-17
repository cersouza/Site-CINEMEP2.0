<?php 	
	include_once('includes/cabecalho.php');
	
	if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
		$id = $_GET['id'];
	} else if ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
		$id = $_POST['id'];
	} else {
		header("Location: ator_menu.php");
		exit();
	}
	
	require_once('BD/conecta.php');
	
	if (isset($_POST['enviou']))
	{	
		$erros = array();
		
		if (empty($_POST['atr_nome'])) {
	        $erros[] = 'Você esqueceu de digitar um nome.';
		} else {
			$nome = mysqli_real_escape_string($dbc, trim($_POST['atr_nome']));
        }

        if (empty($_POST['atr_datanasc'])) {
	        $erros[] = 'Você esqueceu de digitar uma data de nascimento.';
		} else {
            $datanasc = mysqli_real_escape_string($dbc, trim($_POST['atr_datanasc']));
            $datanasc = date("Y-m-d", strtotime($datanasc));
        }
        
		if (empty($erros)) {
			$q = "UPDATE ator SET atr_nome = '$nome', atr_Datanasc = '$datanasc' WHERE atr_codigo = $id";
				
			$r = @mysqli_query($dbc, $q);
			if ($r) {
			  $sucesso = "<h1><strong>Sucesso!</strong></h1>
			    <p>Seu registro foi alterado com sucesso!</p>
			    <p>Aguarde... Redirecionando!</p>";
		     	 echo "<meta HTTP-EQUIV='refresh' 
	     		 CONTENT='3;URL=ator_menu.php'>";
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
    
	$q = "SELECT atr_codigo,atr_nome,atr_Datanasc FROM ator WHERE atr_codigo=$id";
	$r = @mysqli_query($dbc, $q);
	
	if (mysqli_num_rows($r) == 1)
	{
		$row = mysqli_fetch_array($r, MYSQLI_NUM);
?>	

<div class="col-sm-9 col-sm-offset-3 col-md-12 col-md-offset-2 main">
    <h1 class="page-header">Alteração de Ator</h1>
			
	<?php
		if	(isset($erro))
			echo "<div class='alert alert-danger'>$erro</div>";
			
		if	(isset($sucesso))
			echo "<div class='alert alert-success'>$sucesso</div>";
	?>
	
  <form method="post" action="ator_alt.php">
			
		<div id="actions" align="right">
				<a class="btn btn-default" href="dashboard.php?tb=ator&op=menu">Voltar Página Anterior</a>
				<input type="submit" class="btn btn-warning" value="Salvar Alteração" />
		</div>

		<div class="row">
			<div class="form-group col-md-12">

            <label>Nome</label>
				<input type="text" name="atr_nome" maxlength="50" class="form-control"
					placeholder="Digite o nome" value="<?php echo $row[1] ?>"/>	

                <label>Data Nascimento</label>
				<input type="date" name="atr_datanasc" maxlength="50" class="form-control"
                    data-date-format="DD MMMM YYYY" 
                    placeholder="Digite uma data de nascimento." value="<?php echo date("Y-m-d", strtotime($row[2]))?>"/>				
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