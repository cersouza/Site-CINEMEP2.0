<?php 	
	include_once('includes/cabecalho.php');
	
	if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
		$id = $_GET['id'];
	} else if ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
		$id = $_POST['id'];
	} else	{
		header("Location: genero_menu.php");
		exit();
	}
	
	require_once('BD/conecta.php');
	
	if (isset($_POST['enviou']))
	{	
		$erros = array();
		
		if (empty($_POST['gen_descricao'])) {
	        $erros[] = 'Você esqueceu de digitar uma descrição.';
		} else {
			$descricao = mysqli_real_escape_string($dbc, trim($_POST['gen_descricao']));
		}	
        
        //Verifica se há erros
		if (empty($erros)) {
			//SQL de alteração
			$q = "UPDATE genero SET gen_descricao = '$descricao' WHERE gen_codigo = $id";
				
			$r = @mysqli_query($dbc, $q);
			if ($r) {
			  $sucesso = "<h1><strong>Sucesso!</strong></h1>
			    <p>Seu registro foi alterado com sucesso!</p>
			    <p>Aguarde... Redirecionando!</p>";
		     	 echo "<meta HTTP-EQUIV='refresh' 
	     		 CONTENT='3;URL=genero_menu.php'>";
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
    
	$q = "SELECT gen_codigo,gen_descricao FROM genero WHERE gen_codigo=$id";
	$r = @mysqli_query($dbc, $q);
	
	if (mysqli_num_rows($r) == 1)
	{
		$row = mysqli_fetch_array($r, MYSQLI_NUM);
?>	

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Alteração de Genero</h1>
			
	<?php
		if	(isset($erro))
			echo "<div class='alert alert-danger'>$erro</div>";
			
		if	(isset($sucesso))
			echo "<div class='alert alert-success'>$sucesso</div>";
	?>
	
  <form method="post" action="genero_alt.php">
			
		<div id="actions" align="right">
			<a class="btn btn-default" href="genero_menu.php">Fechar sem Salvar</a>
				<input type="submit" class="btn btn-warning" value="Salvar Alteração" />
		</div>

		<div class="row">
			<div class="form-group col-md-12">

				<label>Descrição</label>
				<input type="text" name="gen_descricao" maxlength="50" class="form-control"
					placeholder="Digite a descrição" value="<?php echo $row[1]; ?>"/>				
	        </div>					
		</div>	

		<input type="hidden" name="enviou" value="True" />
		<input type="hidden" name="id" value="<?php echo $row[0]; ?>" />
	</form> 
		  
<?php 
	}
	mysqli_close($dbc);
	include_once('includes/rodape.php'); 
?>