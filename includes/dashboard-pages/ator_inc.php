<?php 	
	if (isset($_POST['enviou']))
	{
		require_once('BD/conecta.php');
		
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
                
		if (empty($erros))
		{
			$q = "INSERT INTO Ator (atr_nome,atr_datanasc)
				VALUES ('$nome','$datanasc')";
				
			$r = @mysqli_query($dbc, $q);
			if ($r)
			{
			  $sucesso = "<h1><strong>Sucesso!</strong></h1>
			  <p>Seu registro foi incluido com sucesso!</p>
			  <p>Aguarde... Redirecionando!</p>";
			 echo "<meta HTTP-EQUIV='refresh' 
			 CONTENT='3;URL=dashboard.php?tb=ator&op=menu'>";
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
    <h1 class="page-header">Cadastro de Ator</h1>
			
	<?php
		if	(isset($erro))
			echo "<div class='alert alert-danger'>$erro</div>";
			
		if	(isset($sucesso))
			echo "<div class='alert alert-success'>$sucesso</div>";
	?> 

	<form method="post" action="dashboard.php?tb=ator&op=inc">
			
		<div id="actions" align="right">
			<a class="btn btn-default" href="dashboard.php?tb=ator&op=menu">Voltar Página Anterior</a>
			<input type="submit" class="btn btn-primary" value="Salvar" />
		</div>
				
		<div class="row">
			<div class="form-group col-md-12">

                <label>Nome</label>
				<input type="text" name="atr_nome" maxlength="50" class="form-control"
					placeholder="Digite o nome" value="<?php if (isset($_POST['atr_nome']))
					echo $_POST['atr_nome']; ?>"/>	

                <label>Data Nascimento</label>
				<input type="date" name="atr_datanasc" maxlength="50" class="form-control"
                    data-date-format="DD MMMM YYYY" 
                    placeholder="Digite uma data de nascimento." value="<?php if (isset($_POST['atr_datanasc']))
					echo $_POST['atr_datanasc']; ?>"/>				
	        </div>					
		</div>			

 		<input type="hidden" name="enviou" value="True" />
	</form>
</div>	