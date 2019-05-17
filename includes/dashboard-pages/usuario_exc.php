<?php 
	require_once('BD/conecta.php');

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
		} else {
			header("Location: usuario_menu.php");
			exit();
		}
    }
    
    //Verifica se há erros
    if (isset($_POST['enviou']))
    {
        $q = "delete from usuario where usu_codigo=$id";
            
        $r = @mysqli_query($dbc, $q);
        if ($r)
        {
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=usuario_menu.php'>";
        } else {
            $erro = "<h1><strong>Erro!</strong></h1><p>Algo errado não está certo</p>";
        }
    } 

	$q = "select usu_codigo,usu_nome,usu_usuario,usu_senha,usu_email from usuario where usu_codigo=$id";

	$row = @mysqli_query($dbc, $q);

	if (mysqli_num_rows($row) == 1) {
		$r = mysqli_fetch_array($row, MYSQLI_NUM);
?>	
<div class="container">
	<div class="row">
		<div class="col-sm-9 col-sm-offset-3 col-md-12 col-md-offset-2 main">
			<h1 class="page-header">Exclusão de Usuário</h1>	
			<?php
				if	(isset($erro))
					echo "<div class='alert alert-danger'>$erro</div>";
			
				if	(isset($sucesso))
					echo "<div class='alert alert-success'>$sucesso</div>";
			?>

			<form method="POST" action="usuario_exc.php">
			
				<div id="actions" align="right">
					<a class="btn btn-default" href="dashboard.php?tb=usuario&op=menu">Voltar Página Anterior</a>
					<input type="submit" class="btn btn-primary" value="Excluir" />
				</div>
				
                <div class="row">
                    <div class="form-group col-md-12">

                        <label>Nome</label>
                        <input type="text" name="usu_nome" maxlength="50" class="form-control" 
                            placeholder="Digite o nome do usuário" value="<?php echo $r[1]; ?>" disabled/>				
                        
                        <div class="row">
                            <div class="col-md-5">
                                <label>Usuário</label>
                                <input type="text" name="usu_usuario" maxlength="25" class="form-control"
                                    placeholder="Digite o usuário" value="<?php echo $r[2]; ?>" disabled/>       
                            </div>

                            <div class="col-md-2">
                            </div>

                            <div class="col-md-5">				
                                <label>Senha</label>
                                <input type="password" name="usu_senha" maxlength="20" class="form-control"
                                    placeholder="Digite a senha" value="<?php echo $r[3]; ?>" disabled/>
                            </div>	
                        </div>		
                    
                        <label>E-mail</label>
                        <input type="email" name="usu_email" maxlength="100" class="form-control"
                             placeholder="Digite o e-mail do usuário" value="<?php echo $r[4]; ?>" disabled/>
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
?>