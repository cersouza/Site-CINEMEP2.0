<?php 
include_once("includes/cabecalho.php");
	require_once('BD/conecta.php');

	if (isset($_POST['enviou']))
	{	
		$erros = array();
		
		if (empty($_POST['usu_nome'])) {
	        $erros[] = 'Você esqueceu de digitar um nome.';
		} else {
			$nome = mysqli_real_escape_string($dbc, trim($_POST['usu_nome']));
		}

    if (empty($_POST['usu_usuario'])) {
	        $erros[] = 'Você esqueceu de digitar um usuário.';
		} else {
			$usuario = mysqli_real_escape_string($dbc, trim($_POST['usu_usuario']));
		}
    
		if (empty($_POST['usu_senha'])) {
	        $erros[] = 'Você esqueceu de digitar uma senha.';
		} else {
			$senha = mysqli_real_escape_string($dbc, trim($_POST['usu_senha']));
    }          

		if (empty($_POST['usu_email'])) {
	        $erros[] = 'Você esqueceu de digitar um e-mail.';
		} else {
			$email = mysqli_real_escape_string($dbc, trim($_POST['usu_email']));
    }		
        
    //Verifica se há erros
		if (empty($erros)) {
			//SQL de alteração
			$q = "UPDATE Usuario SET usu_nome = '$nome',usu_usuario = '$usuario',usu_senha = '$senha', usu_email = '$email' 
					WHERE usu_codigo =".$_SESSION['usu_id'];
				
			$r = @mysqli_query($dbc, $q);
			if ($r) {
			  $sucesso = "<h1><strong>Sucesso!</strong></h1>
			    <p>Seu registro foi alterado com sucesso!</p>
			    <p>Aguarde... Redirecionando!</p>";
		     	 echo "<meta HTTP-EQUIV='refresh' 
	     		 CONTENT='3;URL=index.php'>";
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
        
	//Pesquisa para exibir o registro para alteração
	$q = "SELECT usu_codigo,usu_nome,usu_usuario,usu_senha,usu_email FROM Usuario WHERE usu_codigo=".$_SESSION['usu_id'];
	$r = @mysqli_query($dbc, $q);
	
	if (mysqli_num_rows($r) == 1)
	{
		$row = mysqli_fetch_array($r, MYSQLI_NUM);
?>	

<div class="container" style="height: 26rem;">
<div class="row">
<div class="col-md-12 main p-4">

    <h1 class="page-header">Alteração de Usuário</h1>
			
	<?php
		if	(isset($erro))
			echo "<div class='alert alert-danger'>$erro</div>";
			
		if	(isset($sucesso))
			echo "<div class='alert alert-success'>$sucesso</div>";
	?>
	
  <form method="post" action="alt-cadastro.php">
			
		<div id="actions" align="right">
				<input type="submit" class="btn btn-warning" value="Salvar Alteração" />
		</div>

		<div class="row">
			<div class="form-group col-md-12">

				<label>Nome</label>
				<input type="text" name="usu_nome" maxlength="50" class="form-control" 
					placeholder="Digite o nome do usuário" value="<?php echo $row[1]; ?>"/>				
				
				<div class="row">
					<div class="col-md-5">
						<label>Usuário</label>
						<input type="text" name="usu_usuario" maxlength="25" class="form-control"
							placeholder="Digite o usuário" value="<?php echo $row[2]; ?>"/>       
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-5">				
						<label>Senha</label>
						<input type="password" name="usu_senha" maxlength="20" class="form-control"
							placeholder="Digite a senha" value="<?php echo $row[3]; ?>"/>
					</div>	
				</div>		
			
		  	<label>E-mail</label>
				<input type="email" name="usu_email" maxlength="100" class="form-control"
					placeholder="Digite o e-mail do usuário" value="<?php echo $row[4]; ?>"/>
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
	include_once("includes/rodape.php");
?>