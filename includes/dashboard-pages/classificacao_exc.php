<?php 
	include_once('includes/cabecalho.php');

	require_once('BD/conecta.php');

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
		} else {
			header("Location: classificacao_menu.php");
			exit();
		}
    }
    
    //Verifica se há erros
    if (isset($_POST['enviou']))
    {
        $q = "delete from classificacao where cla_codigo=$id";
            
        $r = @mysqli_query($dbc, $q);
        if ($r)
        {
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=classificacao_menu.php'>";
        } else {
            $erro = "<h1><strong>Erro!</strong></h1><p>Algo errado não está certo</p>";
        }
    } 

	$q = "select cla_codigo,cla_descricao from classificacao where cla_codigo=$id";

	$row = @mysqli_query($dbc, $q);

	if (mysqli_num_rows($row) == 1) {
		$r = mysqli_fetch_array($row, MYSQLI_NUM);
?>	
<div class="container">
	<div class="row">
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header">Exclusão de Classificação</h1>	
			<?php
				if	(isset($erro))
					echo "<div class='alert alert-danger'>$erro</div>";
			
				if	(isset($sucesso))
					echo "<div class='alert alert-success'>$sucesso</div>";
			?>

			<form method="POST" action="classificacao_exc.php">
			
				<div id="actions" align="right">
					<a class="btn btn-default" href="classificacao_menu.php">Fechar sem Excluir</a>
					<input type="submit" class="btn btn-primary" value="Excluir" />
				</div>
				
                <div class="row">
                    <div class="form-group col-md-12">

                        <label>Descrição</label>
                        <input type="text" name="cla_descricao" maxlength="50" class="form-control"
                            placeholder="Digite a descrição" value="<?php echo $r[1]; ?>" disabled/>				
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