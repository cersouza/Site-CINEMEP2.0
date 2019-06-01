<?php 	
	include_once('includes/cabecalho.php');
	
	if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
		$id = $_GET['id'];
	} else if ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
		$id = $_POST['id'];
	} else	{
		header("Location: dashboard.php?tb=moderador&op=menu");
		exit();
	}
	
	require_once('BD/conecta.php');
	
	if (isset($_POST['enviou']))
	{	
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
		if (empty($erros)) {
			//SQL de alteração
			$q = "UPDATE moderador SET mod_nome = '$nome',mod_usuario = '$usuario',mod_senha = '$senha',mod_email = '$email',
                mod_situacao = 'Ativo',mod_telefone = '$telefone',mod_cpf = '$cpf'
				WHERE mod_codigo = $id";
				
			$r = @mysqli_query($dbc, $q);
            
            if ($r) {
			  $sucesso = "<h1><strong>Sucesso!</strong></h1>
			    <p>Seu registro foi alterado com sucesso!</p>
			    <p>Aguarde... Redirecionando!</p>";
		     	 echo "<meta HTTP-EQUIV='refresh' 
	     		 CONTENT='3;URL=dashboard.php?tb=moderador&op=menu'>";
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
	$q = "SELECT mod_codigo,mod_nome,mod_usuario,mod_senha,mod_email,mod_telefone,mod_cpf FROM moderador WHERE mod_codigo=$id";
	$r = @mysqli_query($dbc, $q);
	
	if (mysqli_num_rows($r) == 1)
	{
		$row = mysqli_fetch_array($r, MYSQLI_NUM);
?>	

<div class="col-sm-9 col-sm-offset-3 col-md-12 col-md-offset-2 main">
    <h1 class="page-header">Alteração de Moderador</h1>
			
	<?php
		if	(isset($erro))
			echo "<div class='alert alert-danger'>$erro</div>";
			
		if	(isset($sucesso))
			echo "<div class='alert alert-success'>$sucesso</div>";
	?>
	
  <form method="post" action="dashboard.php?tb=moderador&op=alt">
			
		<div id="actions" align="right">
		<a class="btn btn-default" href="dashboard.php?tb=moderador&op=menu">Voltar Página Anterior</a>
				<input type="submit" class="btn btn-warning" value="Salvar Alteração" />
		</div>

        <div class="row">
			<div class="form-group col-md-12">

				<label>Nome</label>
				<input type="text" name="mod_nome" maxlength="50" class="form-control"
					placeholder="Digite o nome" value="<?php echo $row[1]; ?>"/>				
				
				<div class="row">
					<div class="col-md-5">
						<label>Usuário</label>
						<input type="text" name="mod_usuario" maxlength="25" class="form-control"
							placeholder="Digite o usuário" value="<?php echo $row[2]; ?>"/>       
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-5">				
						<label>Senha</label>
						<input type="password" name="mod_senha" maxlength="20" class="form-control"
							placeholder="Digite a senha" value="<?php echo $row[3]; ?>"/>
					</div>	
				</div>		
			
		  		<label>E-mail</label>
				<input type="email" name="mod_email" maxlength="100" class="form-control"
					placeholder="Digite o e-mail" value="<?php echo $row[4]; ?>"/>

                
				<div class="row">
					<div class="col-md-5">
						<label>Telefone</label>
						<input type="text" name="mod_telefone" maxlength="15" class="form-control"
							placeholder="Digite o telefone" value="<?php echo $row[5]; ?>"/>       
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-5">				
						<label>CPF</label>
						<input type="text" name="mod_cpf" maxlength="11" class="form-control"
							placeholder="Digite o CPF" value="<?php echo $row[6]; ?>"/>
					</div>	
				</div>		
					
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