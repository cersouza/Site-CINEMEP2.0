<?php 
	include_once('includes/cabecalho.php');

	require_once('BD/conecta.php');

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
		} else {
			header("Location: distribuidora_menu.php");
			exit();
		}
    }
    
    //Verifica se há erros
    if (isset($_POST['enviou']))
    {
        $q = "delete from distribuidora where dis_codigo=$id";
            
        $r = @mysqli_query($dbc, $q);
        if ($r)
        {
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=distribuidora_menu.php'>";
        } else {
            $erro = "<h1><strong>Erro!</strong></h1><p>Algo errado não está certo</p>";
        }
    } 

	$q = "SELECT dis_codigo,dis_razaosocial, dis_nomefantasia, dis_cnpj, dis_ie, dis_site, dis_email, dis_endereco, dis_bairro,
          dis_cidade, dis_estado, dis_numero FROM distribuidora WHERE dis_codigo=$id";

	$row = @mysqli_query($dbc, $q);

	if (mysqli_num_rows($row) == 1) {
		$r = mysqli_fetch_array($row, MYSQLI_NUM);
?>	
<div class="container">
	<div class="row">
		<div class="col-sm-9 col-sm-offset-3 col-md-12 col-md-offset-2 main">
			<h1 class="page-header">Exclusão de Distribuidora</h1>	
			<?php
				if	(isset($erro))
					echo "<div class='alert alert-danger'>$erro</div>";
			
				if	(isset($sucesso))
					echo "<div class='alert alert-success'>$sucesso</div>";
			?>

			<form method="POST" action="distribuidora_exc.php">
			
				<div id="actions" align="right">
                    <a class="btn btn-default" href="dashboard.php?tb=distribuidora&op=menu">Voltar Página Anterior</a>
					<input type="submit" class="btn btn-primary" value="Excluir" />
				</div>
				
                <div class="row">
                    <div class="form-group col-md-12">
                    <label>Razão Social</label>
				<input type="text" name="dis_razaosocial" maxlength="50" class="form-control"
					placeholder="Digite uma razão social" value="<?php echo $r[1]; ?>" disabled/>

                <label>Nome Fantasia</label>
                <input type="text" name="dis_nomefantasia" maxlength="50" class="form-control"
                    placeholder="Digite um nome fantasia" value="<?php echo $r[2]; ?>" disabled/>	

                <div class="row">
                    <div class="col-md-5">
                        <label>CNPJ</label>
                        <input type="text" name="dis_cnpj" maxlength="14" class="form-control"
                            placeholder="Digite o CNPJ" value="<?php echo $r[3]; ?>" disabled/>       
                    </div>

                    <div class="col-md-2">
                    </div>

                    <div class="col-md-5">				
                        <label>IE</label>
                        <input type="text" name="dis_ie" maxlength="14" class="form-control"
                            placeholder="Digite o IE" value="<?php echo $r[4] ?>" disabled/>
                    </div>	
                </div>		

                <label>Site</label>
                <input type="url" name="dis_site" maxlength="100" class="form-control"
                    placeholder="Digite o Site" value="<?php echo $r[5]; ?>" disabled/>
                
                <label>E-mail</label>
                <input type="email" name="dis_email" maxlength="100" class="form-control"
                    placeholder="Digite o E-mail" value="<?php echo $r[6]; ?>" disabled/>		

                <div class="row">
                    <div class="col-md-6">
                        <label>Endereço</label>
                        <input type="text" name="dis_endereco" maxlength="60" class="form-control"
                            placeholder="Digite o Endereço" value="<?php echo $r[7] ?>" disabled/>       
                    </div>

                    <div class="col-md-1">
                    </div>

                    <div class="col-md-5">				
                        <label>Bairro</label>
                        <input type="text" name="dis_bairro" maxlength="40" class="form-control"
                            placeholder="Digite o Bairro" value="<?php echo $r[8]; ?>" disabled/>
                    </div>	
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <label>Cidade</label>
                        <input type="text" name="dis_cidade" maxlength="32" class="form-control"
                            placeholder="Digite o Cidade" value="<?php echo $r[9]; ?>" disabled/>       
                    </div>

                    <div class="col-md-1">
                    </div>
                    
                    <div class="col-md-2">
                        <label>Estado</label>
                        <input type="text" name="dis_estado" maxlength="3" class="form-control"
                            placeholder="Digite um estado" value="<?php echo $r[10]; ?>" disabled/>
                    </div>

                    <div class="col-md-1">
                    </div>

                    <div class="col-md-3">				
                        <label>Número</label>
                        <input type="text" name="dis_numero" maxlength="5" class="form-control"
                            placeholder="Digite um número" value="<?php echo $r[11]; ?>" disabled/>
                    </div>					
                </div>

				<input type="hidden" name="enviou" value="True" />
				<input type="hidden" name="id" value="<?php echo $r[0]; ?>" />
			</form>
		</div>
	</div>
</div>
</div>
</div>
</div>
</div>
<?php
	}
	mysqli_close($dbc);
	include_once('includes/rodape.php');
?>