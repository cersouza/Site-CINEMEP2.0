<?php 
	include_once('includes/cabecalho.php');
	
	if (isset($_POST['enviou']))
	{
		require_once('BD/conecta.php');
		
		$erros = array();
		
		if (empty($_POST['cla_descricao'])) {
	        $erros[] = 'Você esqueceu de digitar uma descrição.';
		} else {
			$descricao = mysqli_real_escape_string($dbc, trim($_POST['cla_descricao']));
        }
                
		if (empty($erros))
		{
			$q = "INSERT INTO classificacao (cla_descricao)
				VALUES ('$descricao')";
				
			$r = @mysqli_query($dbc, $q);
			if ($r)
			{
			  $sucesso = "<h1><strong>Sucesso!</strong></h1>
			  <p>Seu registro foi incluido com sucesso!</p>
			  <p>Aguarde... Redirecionando!</p>";
			 echo "<meta HTTP-EQUIV='refresh' 
			 CONTENT='3;URL=dashboard.php?tb=classificacao&op=menu'>";
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
?>	

<div class="col-sm-9 col-sm-offset-3 col-md-12 col-md-offset-2 main">
    <h1 class="page-header">Cadastro de Classificação</h1>
			
	<?php
		if	(isset($erro))
			echo "<div class='alert alert-danger'>$erro</div>";
			
		if	(isset($sucesso))
			echo "<div class='alert alert-success'>$sucesso</div>";
	?> 

	<form method="post" action="dashboard.php?tb=classificacao&op=inc">
			
		<div id="actions" align="right">
				<a class="btn btn-default" href="dashboard.php?tb=classificacao&op=menu">Voltar Página Anterior</a>
				<input type="submit" class="btn btn-primary" value="Salvar" />
		</div>
				
		<div class="row">
			<div class="form-group col-md-12">

				<label>Descrição</label>
				<input type="text" name="cla_descricao" maxlength="50" class="form-control"
					placeholder="Digite a descrição" value="<?php if (isset($_POST['cla_descricao']))
					echo $_POST['cla_descricao']; ?>"/>				
	        </div>					
		</div>			

 		<input type="hidden" name="enviou" value="True" />
	</form>
</div>	
</div>
</div>

<?php include_once('includes/rodape.php'); ?>