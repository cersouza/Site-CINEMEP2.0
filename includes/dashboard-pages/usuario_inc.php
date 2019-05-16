<?php 
	include_once('includes/cabecalho.php');
	
	if (isset($_POST['enviou']))
	{
		require_once('BD/conecta.php');
		
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
		if (empty($erros))
		{
			//SQL de inserção
			$q = "INSERT INTO usuario (usu_nome,usu_usuario,usu_senha,usu_email,usu_situacao)
				VALUES ('$nome','$usuario','$senha','$email','Ativo')";
				
			$r = @mysqli_query($dbc, $q);
			if ($r)
			{
			  $sucesso = "<h1><strong>Sucesso!</strong></h1>
			  <p>Seu registro foi incluido com sucesso!</p>
			  <p>Aguarde... Redirecionando!</p>";
			 echo "<meta HTTP-EQUIV='refresh' 
			 CONTENT='3;URL=usuario_menu.php'>";
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

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Cadastro de Usuário</h1>
			
	<?php
		if	(isset($erro))
			echo "<div class='alert alert-danger'>$erro</div>";
			
		if	(isset($sucesso))
			echo "<div class='alert alert-success'>$sucesso</div>";
	?> 

	<form method="post" action="usuario_inc.php">
			
		<div id="actions" align="right">
			<a class="btn btn-default" href="usuario_menu.php">Fechar sem Salvar</a>
				<input type="submit" class="btn btn-primary" value="Salvar" />
		</div>
				
		<div class="row">
			<div class="form-group col-md-12">

				<label>Nome</label>
				<input type="text" name="usu_nome" maxlength="50" class="form-control"
					placeholder="Digite o nome do usuário" value="<?php if (isset($_POST['usu_nome']))
					echo $_POST['usu_nome']; ?>"/>				
				
				<div class="row">
					<div class="col-md-5">
						<label>Usuário</label>
						<input type="text" name="usu_usuario" maxlength="25" class="form-control"
							placeholder="Digite o usuário" value="<?php if (isset($_POST['usu_usuario']))
							echo $_POST['usu_usuario']; ?>"/>       
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-5">				
						<label>Senha</label>
						<input type="password" name="usu_senha" maxlength="20" class="form-control"
							placeholder="Digite a senha" value="<?php if (isset($_POST['usu_senha']))
							echo $_POST['usu_senha']; ?>"/>
					</div>	
				</div>		
			
		  	<label>E-mail</label>
				<input type="email" name="usu_email" maxlength="100" class="form-control"
					placeholder="Digite o e-mail do usuário" value="<?php if (isset($_POST['usu_email']))
					echo $_POST['usu_email']; ?>"/>
	    </div>					
		</div>			

 		<input type="hidden" name="enviou" value="True" />
	</form>
</div>	

<?php include_once('includes/rodape.php'); ?>