<?php 
	include_once('includes/cabecalho.php');
	
	if (isset($_POST['enviou']))
	{
		require_once('BD/conecta.php');
		
		$erros = array();
		
		if (empty($_POST['mod_nome'])) {
	        $erros[] = 'Você esqueceu de digitar um nome.';
		} else {
			$nome = mysqli_real_escape_string($dbc, trim($_POST['mod_nome']));
        }
        
        if (empty($_POST['mod_usuario'])) {
	        $erros[] = 'Você esqueceu de digitar um usuário.';
	    } else {
	        $usuario = mysqli_real_escape_string($dbc, trim($_POST['mod_usuario']));
	    }
    
	    if (empty($_POST['mod_senha'])) {
	        $erros[] = 'Você esqueceu de digitar uma senha.';
	    } else {
	    	$senha = mysqli_real_escape_string($dbc, trim($_POST['mod_senha']));
        }

	    if (empty($_POST['mod_email'])) {
	        $erros[] = 'Você esqueceu de digitar um e-mail.';
	    } else {
	    	$email = mysqli_real_escape_string($dbc, trim($_POST['mod_email']));
        }
        
        if (empty($_POST['mod_telefone'])) {
	        $erros[] = 'Você esqueceu de digitar um telefone.';
	    } else {
	    	$telefone = mysqli_real_escape_string($dbc, trim($_POST['mod_telefone']));
        }
        
        if (empty($_POST['mod_cpf'])) {
	        $erros[] = 'Você esqueceu de digitar o CPF.';
	    } else {
	    	$cpf = mysqli_real_escape_string($dbc, trim($_POST['mod_cpf']));
        }
    
		//Verifica se há erros
		if (empty($erros))
		{
			//SQL de inserção
			$q = "INSERT INTO moderador (mod_nome,mod_usuario,mod_senha,mod_email,mod_situacao,mod_telefone,mod_cpf)
				VALUES ('$nome','$usuario','$senha','$email','Ativo','$telefone','$cpf')";
				
			$r = @mysqli_query($dbc, $q);
			if ($r)
			{
			  $sucesso = "<h1><strong>Sucesso!</strong></h1>
			  <p>Seu registro foi incluido com sucesso!</p>
			  <p>Aguarde... Redirecionando!</p>";
			  echo "<meta HTTP-EQUIV='refresh' 
			  CONTENT='3;URL=dashboard.php?tb=moderador&op=menu'>";
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
    <h1 class="page-header">Cadastro de Moderador</h1>
			
	<?php
		if	(isset($erro))
			echo "<div class='alert alert-danger'>$erro</div>";
			
		if	(isset($sucesso))
			echo "<div class='alert alert-success'>$sucesso</div>";
	?> 

	<form method="post" action="dashboard.php?tb=moderador&op=inc">
			
		<div id="actions" align="right">
			<a class="btn btn-default" href="dashboard.php?tb=moderador&op=menu">Voltar Página Anterior</a>
				<input type="submit" class="btn btn-primary" value="Salvar" />
		</div>
				
		<div class="row">
			<div class="form-group col-md-12">

				<label>Nome</label>
				<input type="text" name="mod_nome" maxlength="50" class="form-control"
					placeholder="Digite o nome" value="<?php if (isset($_POST['mod_nome']))
					echo $_POST['mod_nome']; ?>"/>				
				
				<div class="row">
					<div class="col-md-5">
						<label>Usuário</label>
						<input type="text" name="mod_usuario" maxlength="25" class="form-control"
							placeholder="Digite o usuário" value="<?php if (isset($_POST['mod_usuario']))
							echo $_POST['mod_usuario']; ?>"/>       
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-5">				
						<label>Senha</label>
						<input type="password" name="mod_senha" maxlength="20" class="form-control"
							placeholder="Digite a senha" value="<?php if (isset($_POST['mod_senha']))
							echo $_POST['mod_senha']; ?>"/>
					</div>	
				</div>		
			
		  		<label>E-mail</label>
				<input type="email" name="mod_email" maxlength="100" class="form-control"
					placeholder="Digite o e-mail" value="<?php if (isset($_POST['mod_email']))
					echo $_POST['mod_email']; ?>"/>

                
				<div class="row">
					<div class="col-md-5">
						<label>Telefone</label>
						<input type="tel" name="mod_telefone" maxlength="15" class="form-control"
							pattern="[0-9]{5}-[0-9]{4}"
							placeholder="Digite o telefone" value="<?php if (isset($_POST['mod_telefone']))
							echo $_POST['mod_telefone']; ?>"/>       
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-5">				
						<label>CPF</label>
						<input type="text" name="mod_cpf" maxlength="11" class="form-control"
							placeholder="Digite o CPF" value="<?php if (isset($_POST['mod_cpf']))
							echo $_POST['mod_cpf']; ?>"/>
					</div>	
				</div>		
					
	    	</div>					
		</div>			

 		<input type="hidden" name="enviou" value="True" />
	</form>
</div>	
</div>
</div>

<?php include_once('includes/rodape.php'); ?>