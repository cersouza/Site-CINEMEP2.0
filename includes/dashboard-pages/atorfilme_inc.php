<?php 
	include_once('includes/cabecalho.php');
    
    if (isset($_POST['fil']) && is_numeric($_POST['fil'])) {
        $fil = $_POST['fil'];
    } else if (isset($_GET['fil']) && is_numeric($_GET['fil'])) {
        $fil = $_GET['fil'];
    } else {
        header("Location: filme_menu.php");
		exit();		
    }   

	if (isset($_POST['enviou']))
	{
		require_once('BD/conecta.php');
		
		$erros = array();
		
		if (empty($_POST['atfl_atr_codigo'])) {
	        $erros[] = 'Você esqueceu de escolher um ator.';
		} else {
			$ator = mysqli_real_escape_string($dbc, trim($_POST['atfl_atr_codigo']));
        }

        if (empty($_POST['atfl_papel'])) {
	        $erros[] = 'Você esqueceu de digitar um papel.';
		} else {
			$papel = mysqli_real_escape_string($dbc, trim($_POST['atfl_papel']));
        }

        if (empty($_POST['atfl_importancia'])) {
	        $erros[] = 'Você esqueceu de escolher a importância.';
		} else {
			$importancia = mysqli_real_escape_string($dbc, trim($_POST['atfl_importancia']));
        }

		if (empty($erros))
		{
			$q = "INSERT INTO atorfilme (Atfl_Atr_Codigo,Atfl_Fil_Codigo,Atfl_Papel,Atfl_Importancia)
				VALUES ($ator,$fil,'$papel','$importancia')";
				
			$r = @mysqli_query($dbc, $q);
			if ($r)
			{
				$href = "atorfilme_menu.php?fil=" . $fil;
                $sucesso = "<h1><strong>Sucesso!</strong></h1>
			    <p>Seu registro foi alterado com sucesso!</p>
                <p>Aguarde... Redirecionando!</p>";
                echo "<meta HTTP-EQUIV='refresh' 
                CONTENT='3;URL=$href'>";			}
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
    <h1 class="page-header">Cadastro de Ator por filme</h1>
			
	<?php
		if	(isset($erro)){
			echo "<div class='alert alert-danger'>$erro</div>";
   		}	
			
		if	(isset($sucesso))
			echo "<div class='alert alert-success'>$sucesso</div>";
	?> 

	<form method="post" action="atorfilme_inc.php">
			
		<div id="actions" align="right">
			<?php $href = "atorfilme_menu.php?fil=" . $fil;
			?>
			<a class="btn btn-default" href="<?php echo $href?>">Fechar sem Salvar</a>
				<input type="submit" class="btn btn-primary" value="Salvar" />
		</div>
				
		<div class="row">
			<div class="form-group col-md-12">
                
                <label>Ator</label>
                <select name="atfl_atr_codigo" id="atfl_atr_codigo" class="form-control w-3">                    
                    <?php
                        require_once('BD/conecta.php');

                        $gnr = "select atr_codigo,atr_nome from ator";
                        
                        $rg = @mysqli_query($dbc, $gnr);            
                        while($row =  mysqli_fetch_array($rg, MYSQLI_ASSOC)) {
                            echo '<option value="' .$row['atr_codigo']. '">' .$row['atr_nome']. '</option>';
                        }
                    ?>
                </select>

                <label>Papel</label>
                <input type="text" name="atfl_papel" maxlength="50" class="form-control"
                    placeholder="Digite o papel do ator" value="<?php if (isset($_POST['atfl_papel']))
                    echo $_POST['atfl_papel']; ?>"/>
                                
                <label>Importância</label>
                <select name="atfl_importancia" id="atfl_importancia" class="form-control w-3">                
                    <option value="1">1</option>;
                    <option value="2">2</option>;
                    <option value="3">3</option>;         
                </select>    

                <?php 
                    require_once('BD/conecta.php');

                    $atr = '';                
                    $impor = '';

                    if (!empty($_POST['atfl_atr_codigo'])) {
                        $atr = mysqli_real_escape_string($dbc, trim($_POST['atfl_atr_codigo']));
                    }
            
                    if (!empty($_POST['atfl_importancia'])) {
                        $impor = mysqli_real_escape_string($dbc, trim($_POST['atfl_importancia']));
                    }
                    echo '<script>document.getElementById("atfl_atr_codigo").value = "' . $atr . '";</script>';
                    echo '<script>document.getElementById("atfl_importancia").value = "' . $impor . '";</script>';
                ?>				
	        </div>					
		</div>			

        <input type="hidden" name="enviou" value="True" />
        <input type="hidden" name="fil" value="<?php echo $fil; ?>" />
	</form>
</div>		

<?php include_once('includes/rodape.php'); ?>