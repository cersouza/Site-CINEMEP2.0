<?php 
	require_once('BD/conecta.php');

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
		} else {
			header("Location: ator_menu.php");
			exit();
		}
    }
    
    //Verifica se há erros
    if (isset($_POST['enviou']))
    {
        $q = "delete from ator where atr_codigo=$id";
            
        $r = @mysqli_query($dbc, $q);
        if ($r)
        {
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=ator_menu.php'>";
        } else {
            $erro = "<h1><strong>Erro!</strong></h1><p>Algo errado não está certo</p>";
        }
    } 

	$q = "select atr_codigo, atr_nome, atr_datanasc from ator where atr_codigo=$id";

	$row = @mysqli_query($dbc, $q);

	if (mysqli_num_rows($row) == 1) {
		$r = mysqli_fetch_array($row, MYSQLI_NUM);
?>	
<div class="container">
	<div class="row">
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header">Exclusão de Ator</h1>	
			<?php
				if	(isset($erro))
					echo "<div class='alert alert-danger'>$erro</div>";
			
				if	(isset($sucesso))
					echo "<div class='alert alert-success'>$sucesso</div>";
			?>

			<form method="POST" action="ator_exc.php">
			
				<div id="actions" align="right">
					<a class="btn btn-default" href="ator_menu.php">Fechar sem Excluir</a>
					<input type="submit" class="btn btn-primary" value="Excluir" />
				</div>
				
                <div class="row">
                    <div class="form-group col-md-12">

                    <label>Nome</label>
				    <input type="text" name="atr_nome" maxlength="50" class="form-control"
					placeholder="Digite o nome" value="<?php echo $r[1] ?>" disabled/>	

                <label>Data Nascimento</label>
				<input type="date" name="atr_datanasc" maxlength="50" class="form-control"
                    data-date-format="DD MMMM YYYY" 
                    placeholder="Digite uma data de nascimento." value="<?php echo date("Y-m-d", strtotime($r[2]))?>" readonly/>					
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