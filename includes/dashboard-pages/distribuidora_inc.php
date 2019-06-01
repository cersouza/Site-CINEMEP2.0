<?php 
	include_once('includes/cabecalho.php');
	
	if (isset($_POST['enviou']))
	{
		require_once('BD/conecta.php');
		
        $erros = array();
            
		if (empty($_POST['dis_razaosocial'])) {
	        $erros[] = 'Você esqueceu de digitar uma razão social.';
		} else {
			$razaosocial = mysqli_real_escape_string($dbc, trim($_POST['dis_razaosocial']));
        }

        if (empty($_POST['dis_nomefantasia'])) {
	        $erros[] = 'Você esqueceu de digitar um nome fantasia.';
		} else {
			$nomefantasia = mysqli_real_escape_string($dbc, trim($_POST['dis_nomefantasia']));
        }

        if (empty($_POST['dis_cnpj'])) {
	        $erros[] = 'Você esqueceu de digitar um cnpj.';
		} else {
			$cnpj = mysqli_real_escape_string($dbc, trim($_POST['dis_cnpj']));
        }

        if (empty($_POST['dis_ie'])) {
	        $erros[] = 'Você esqueceu de digitar um IE.';
		} else {
			$ie = mysqli_real_escape_string($dbc, trim($_POST['dis_ie']));
        }

        if (empty($_POST['dis_site'])) {
	        $erros[] = 'Você esqueceu de digitar um site.';
		} else {
			$site = mysqli_real_escape_string($dbc, trim($_POST['dis_site']));
        }

        if (empty($_POST['dis_email'])) {
	        $erros[] = 'Você esqueceu de digitar um e-mail.';
		} else {
			$email = mysqli_real_escape_string($dbc, trim($_POST['dis_email']));
        }

        if (empty($_POST['dis_endereco'])) {
	        $erros[] = 'Você esqueceu de digitar um endereço.';
		} else {
			$endereco = mysqli_real_escape_string($dbc, trim($_POST['dis_endereco']));
        }

        if (empty($_POST['dis_bairro'])) {
	        $erros[] = 'Você esqueceu de digitar um bairro.';
		} else {
			$bairro = mysqli_real_escape_string($dbc, trim($_POST['dis_bairro']));
        }
        
        if (empty($_POST['dis_cidade'])) {
	        $erros[] = 'Você esqueceu de digitar uma cidade.';
		} else {
			$cidade = mysqli_real_escape_string($dbc, trim($_POST['dis_cidade']));
        }
            
        if (empty($_POST['dis_estado'])) {
	        $erros[] = 'Você esqueceu de digitar um estado.';
		} else {
			$estado = mysqli_real_escape_string($dbc, trim($_POST['dis_estado']));
        }

        if (empty($_POST['dis_numero'])) {
	        $erros[] = 'Você esqueceu de digitar um número.';
		} else {
			$numero = mysqli_real_escape_string($dbc, trim($_POST['dis_numero']));
        }

		//Verifica se há erros
		if (empty($erros))
		{
            //SQL de inserção
			$q = "INSERT INTO distribuidora (dis_razaosocial,dis_nomefantasia,dis_cnpj,dis_ie,dis_site,dis_email,dis_endereco,dis_bairro,dis_cidade,dis_estado,dis_numero)
				VALUES ('$razaosocial','$nomefantasia','$cnpj','$ie','$site','$email','$endereco','$bairro','$cidade','$estado','$numero')";
				
			$r = @mysqli_query($dbc, $q);
			if ($r)
			{
			  $sucesso = "<h1><strong>Sucesso!</strong></h1>
			  <p>Seu registro foi incluido com sucesso!</p>
			  <p>Aguarde... Redirecionando!</p>";
			  echo "<meta HTTP-EQUIV='refresh' 
			  CONTENT='3;URL=dashboard.php?tb=distribuidora&op=menu'>";
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
    <h1 class="page-header">Cadastro de Distribuidora</h1>
			
	<?php
		if	(isset($erro))
			echo "<div class='alert alert-danger'>$erro</div>";
			
		if	(isset($sucesso))
			echo "<div class='alert alert-success'>$sucesso</div>";
	?> 

	<form method="post" action="dashboard.php?tb=distribuidora&op=inc">
			
		<div id="actions" align="right">
			<a class="btn btn-default" href="dashboard.php?tb=distribuidora&op=menu">Voltar Página Anterior</a>
			<input type="submit" class="btn btn-primary" value="Salvar" />
		</div>
				
		<div class="row">
			<div class="form-group col-md-12">

            <label>Razão Social</label>
				<input type="text" name="dis_razaosocial" maxlength="50" class="form-control"
					placeholder="Digite uma razão social" value="<?php if (isset($_POST['dis_razaosocial']))
					echo $_POST['dis_razaosocial']; ?>"/>

            <label>Nome Fantasia</label>
			<input type="text" name="dis_nomefantasia" maxlength="50" class="form-control"
				placeholder="Digite um nome fantasia" value="<?php if (isset($_POST['dis_nomefantasia']))
				echo $_POST['dis_nomefantasia']; ?>"/>	

            <div class="row">
				<div class="col-md-5">
					<label>CNPJ</label>
					<input type="text" name="dis_cnpj" maxlength="14" class="form-control"
						placeholder="Digite o CNPJ" value="<?php if (isset($_POST['dis_cnpj']))
						echo $_POST['dis_cnpj']; ?>"/>       
				</div>

				<div class="col-md-2">
				</div>

				<div class="col-md-5">				
					<label>IE</label>
					<input type="text" name="dis_ie" maxlength="14" class="form-control"
						placeholder="Digite o IE" value="<?php if (isset($_POST['dis_ie']))
						echo $_POST['dis_ie']; ?>"/>
				</div>	
			</div>		

            <label>Site</label>
			<input type="url" name="dis_site" maxlength="100" class="form-control"
				placeholder="Digite o Site" value="<?php if (isset($_POST['dis_site']))
				echo $_POST['dis_site']; ?>"/>
            
            <label>E-mail</label>
			<input type="email" name="dis_email" maxlength="100" class="form-control"
				placeholder="Digite o E-mail" value="<?php if (isset($_POST['dis_email']))
				echo $_POST['dis_email']; ?>"/>		

            <div class="row">
				<div class="col-md-6">
					<label>Endereço</label>
					<input type="text" name="dis_endereco" maxlength="60" class="form-control"
						placeholder="Digite o Endereço" value="<?php if (isset($_POST['dis_endereco']))
						echo $_POST['dis_endereco']; ?>"/>       
				</div>

				<div class="col-md-1">
				</div>

				<div class="col-md-5">				
					<label>Bairro</label>
					<input type="text" name="dis_bairro" maxlength="40" class="form-control"
						placeholder="Digite o Bairro" value="<?php if (isset($_POST['dis_bairro']))
						echo $_POST['dis_bairro']; ?>"/>
				</div>	
			</div>

            <div class="row">
				<div class="col-md-5">
					<label>Cidade</label>
					<input type="text" name="dis_cidade" maxlength="32" class="form-control"
						placeholder="Digite o Cidade" value="<?php if (isset($_POST['dis_cidade']))
						echo $_POST['dis_cidade']; ?>"/>       
				</div>

                <div class="col-md-1">
				</div>
				
				<div class="col-md-2">
                    <label>Estado</label>
					<select name="dis_estado" id="dis_estado" class="form-control w-3">
                    <option value="AC">AC</option>
                    <option value="AL">AL</option>
                    <option value="AP">AP</option>
                    <option value="AM">AM</option>
                    <option value="BA">BA</option>
                    <option value="CE">CE</option>
                    <option value="DF">DF</option>
                    <option value="ES">ES</option>
                    <option value="GO">GO</option>
                    <option value="MA">MA</option>
                    <option value="MT">MT</option>
                    <option value="MS">MS</option>
                    <option value="MG">MG</option>
                    <option value="PA">PA</option>	 
                    <option value="PB">PB</option>
                    <option value="PR">PR</option>
                    <option value="PE">PE</option>
                    <option value="PI">PI</option>
                    <option value="RJ">RJ</option>
                    <option value="RN">RN</option>
                    <option value="RS">RS</option>
                    <option value="RO">RO</option>
                    <option value="RR">RR</option>
                    <option value="SC">SC</option>
                    <option value="SP">SP</option>
                    <option value="SE">SE</option>
                    <option value="TO">TO</option>						
					</select>
				</div>

				<?php 
					$estado = "SP";
					echo '
						<script>
							document.getElementById("dis_estado").value = "' . $estado . '";
						</script>
					';
				?>

                <div class="col-md-1">
				</div>

				<div class="col-md-3">				
					<label>Número</label>
					<input type="text" name="dis_numero" maxlength="5" class="form-control"
						placeholder="Digite o Número" value="<?php if (isset($_POST['dis_numero']))
						echo $_POST['dis_numero']; ?>"/>
				</div>	
			</div>
	    </div>	   
 		<input type="hidden" name="enviou" value="True" />
	</form>
</div>
</div>	
</div>
</div>

<?php include_once('includes/rodape.php'); ?>