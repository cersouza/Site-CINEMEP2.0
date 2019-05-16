<?php 
	include_once('includes/cabecalho.php');

	require_once('BD/conecta.php');

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
		} else {
			header("Location: moderador_menu.php");
			exit();
		}
    }
    
    //Verifica se há erros
    if (isset($_POST['enviou']))
    {
        $q = "delete from moderador where mod_codigo=$id";
            
        $r = @mysqli_query($dbc, $q);
        if ($r)
        {
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=moderador_menu.php'>";
        } else {
            $erro = "<h1><strong>Erro!</strong></h1><p>Algo errado não está certo</p>";
        }
    } 

	$q = "SELECT mod_codigo,mod_nome,mod_usuario,mod_senha,mod_email,mod_telefone,mod_cpf FROM moderador WHERE mod_codigo=$id";

	$row = @mysqli_query($dbc, $q);

	if (mysqli_num_rows($row) == 1) {
		$r = mysqli_fetch_array($row, MYSQLI_NUM);
?>	
<div class="container">
	<div class="row">
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header">Exclusão de Moderador</h1>	
			<?php
				if	(isset($erro))
					echo "<div class='alert alert-danger'>$erro</div>";
			
				if	(isset($sucesso))
					echo "<div class='alert alert-success'>$sucesso</div>";
			?>

			<form method="POST" action="usuario_exc.php">
			
				<div id="actions" align="right">
					<a class="btn btn-default" href="moderador_menu.php">Fechar sem Excluir</a>
					<input type="submit" class="btn btn-primary" value="Excluir" />
				</div>
				
                <div class="row">
                    <div class="form-group col-md-12">

                        <label>Nome</label>
                        <input type="text" name="mod_nome" maxlength="50" class="form-control"
                            placeholder="Digite o nome" value="<?php echo $r[1]; ?>" disabled/>				
                        
                        <div class="row">
                            <div class="col-md-5">
                                <label>Usuário</label>
                                <input type="text" name="mod_usuario" maxlength="25" class="form-control"
                                    placeholder="Digite o usuário" value="<?php echo $r[2]; ?>" disabled/>       
                            </div>

                            <div class="col-md-2">
                            </div>

                            <div class="col-md-5">				
                                <label>Senha</label>
                                <input type="password" name="mod_senha" maxlength="20" class="form-control"
                                    placeholder="Digite a senha" value="<?php echo $r[3]; ?>" disabled/>
                            </div>	
                        </div>		
                    
                        <label>E-mail</label>
                        <input type="email" name="mod_email" maxlength="100" class="form-control"
                            placeholder="Digite o e-mail" value="<?php echo $r[4]; ?>" disabled/>

                        
                        <div class="row">
                            <div class="col-md-5">
                                <label>Telefone</label>
                                <input type="text" name="mod_telefone" maxlength="15" class="form-control"
                                    placeholder="Digite o telefone" value="<?php echo $r[5]; ?>" disabled/>       
                            </div>

                            <div class="col-md-2">
                            </div>

                            <div class="col-md-5">				
                                <label>CPF</label>
                                <input type="text" name="mod_cpf" maxlength="11" class="form-control"
                                    placeholder="Digite o CPF" value="<?php echo $r[6]; ?>" disabled/>
                            </div>	
                        </div>		
                            
                    </div>					
                </div>    

				<input type="hidden" name="enviou" value="True" />
				<input type="hidden" name="id" value="<?php echo $r[0]; ?>" />
			</form>
		</div>
	</div>
</div>
<?php
	}
	mysqli_close($dbc);
	include_once('includes/rodape.php');
?>