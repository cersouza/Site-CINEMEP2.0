<?php 
	include_once('includes/cabecalho.php');
	
	if (isset($_POST['enviou']))
	{
		require_once('BD/conecta.php');
		
        $erros = array();
		if (empty($_POST['Fil_Titulo'])) {
	        $erros[] = 'Você esqueceu de digitar um título.';
		} else {
			$titulo = mysqli_real_escape_string($dbc, trim($_POST['Fil_Titulo']));
        }

        if (empty($_POST['fil_sinopse'])) {
	        $erros[] = 'Você esqueceu de digitar uma sinopse.';
		} else {
			$sinopse = mysqli_real_escape_string($dbc, trim($_POST['fil_sinopse']));
        }

        if (empty($_POST['fil_lancamento'])) {
	        $erros[] = 'Você esqueceu de digitar uma data de lançamento.';
		} else {
            $lancamento = mysqli_real_escape_string($dbc, trim($_POST['fil_lancamento']));
            $lancamento = date("Y-m-d", strtotime($lancamento));
        }

        if (empty($_POST['fil_tempo'])) {
	        $erros[] = 'Você esqueceu de digitar o tempo do filme.';
		} else {
			$tempo = mysqli_real_escape_string($dbc, trim($_POST['fil_tempo']));
        }

        if (empty($_POST['fil_genero'])) {
	        $erros[] = 'Você esqueceu de digitar um genero.';
		} else {
			$genero = mysqli_real_escape_string($dbc, trim($_POST['fil_genero']));
        }

        if (empty($_POST['fil_classificacao'])) {
	        $erros[] = 'Você esqueceu de digitar uma classificação.';
		} else {
			$classificacao = mysqli_real_escape_string($dbc, trim($_POST['fil_classificacao']));
        }

        if (empty($_POST['fil_distribuidora'])) {
	        $erros[] = 'Você esqueceu de digitar uma distribuidora.';
		} else {
			$distribuidora = mysqli_real_escape_string($dbc, trim($_POST['fil_distribuidora']));
        }

        
        $foto = $_FILES['fil_foto']['tmp_name'];
        $tamanho_permitido = 1024000; //1 MB
        $pasta = 'C:/Xampp/htdocs/Site-CINEMEP/img';

        if (!empty($foto)){
            $file = getimagesize($foto);

            //TESTA O TAMANHO DO ARQUIVO
            if($_FILES['fil_foto']['size'] > $tamanho_permitido){
                $erros[] = "Arquivo muito grande";
            }

            //TESTA A EXTENSÃO DO ARQUIVO
            if(!preg_match('/^image\/(?:gif|jpg|jpeg|png)$/i', $file['mime'])){
                $erros[] =  "Extensão não permitida";
            }

            //CAPTURA A EXTENSÃO DO ARQUIVO
            $extensao = str_ireplace("/", "", strchr($file['mime'], "/"));
        } 

		//Verifica se há erros
		if (empty($erros))
		{
            //SQL de inserção
            
            $novoDestino = "{$pasta}/foto_arquivo_".uniqid('', true) . '.' . $extensao;

			$q = "INSERT INTO Filmes(Fil_Titulo,Fil_Sinopse,Fil_Foto,Fil_Lancamento,Fil_Tempo,Fil_Genero,Fil_Classificacao,Fil_Distribuidora,Fil_Situacao)
				VALUES ('$titulo','$sinopse','$novoDestino','$lancamento','$tempo',$genero,$classificacao,$distribuidora,'Ativo')";
                
			$r = @mysqli_query($dbc, $q);
			if ($r)
			{
                //MONTA O CAMINHO DO NOVO DESTINO
                if (!empty($foto)) {          
                    move_uploaded_file ($foto , $novoDestino );
                }

			  $sucesso = "<h1><strong>Sucesso!</strong></h1>
			  <p>Seu registro foi incluido com sucesso!</p>
			  <p>Aguarde... Redirecionando!</p>";
			 echo "<meta HTTP-EQUIV='refresh' 
			 CONTENT='3;URL=filme_menu.php'>";
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
    <h1 class="page-header">Cadastro de Filme</h1>
			
	<?php
		if	(isset($erro))
			echo "<div class='alert alert-danger'>$erro</div>";
			
		if	(isset($sucesso))
			echo "<div class='alert alert-success'>$sucesso</div>";
	?> 

	<form method="post" action="dashboard.php?tb=filme&op=inc">
			
		<div id="actions" align="right">
			<a class="btn btn-default" href="dashboard.php?tb=filme&op=menu">Voltar Página Anterior</a>
				<input type="submit" class="btn btn-primary" value="Salvar" />
		</div>
				
		<div class="row">
			<div class="form-group col-md-12">

                <label>Título</label>
                <input type="text" name="Fil_Titulo" maxlength="50" class="form-control"
                    placeholder="Digite um título" value="<?php if (isset($_POST['Fil_Titulo']))
                    echo $_POST['Fil_Titulo']; ?>"/>

                <br/>
                <label>Sinopse</label>
                <br/>
                <textarea id="fil_sinopse" name="fil_sinopse" rows="3" cols="60"><?php if (isset($_POST['Fil_Titulo'])) echo $_POST['Fil_Titulo']; ?>
                </textarea>
                <br/>

                <label>Foto</label>
                <input type="file" name="fil_foto" class = "form-control"
                    placeholder="Selecione uma foto" value="<?php if (isset($_POST['fil_foto'])) 
                    echo $_POST['fil_foto']; ?>" />   

                <div class="row">
                    <div class="col-md-3">
                        <label>Data Lançamento</label>
                        <input type="date" name="fil_lancamento" maxlength="50" class="form-control"
                            data-date-format="DD MM YYYY" 
                            placeholder="Digite uma data de lançamento." value="<?php if (isset($_POST['fil_lancamento']))
                            echo $_POST['fil_lancamento']; ?>"/>
                    </div>

                    <div class="col-md-6">
                    </div>

                    <div class="col-md-3">
                        <label>Tempo de filme</label>
                        <input type="text" name="fil_tempo" maxlength="6" class="form-control"
                            placeholder="Digite o tempo do filme" value="<?php if (isset($_POST['fil_tempo']))
                            echo $_POST['fil_tempo']; ?>"/>
                    </div>
                </div> 

                <label>Genero</label>
                <select name="fil_genero" id="fil_genero" class="form-control w-3">                    
                    <?php
                        require_once('BD/conecta.php');

                        $gnr = "select gen_codigo,gen_descricao from Genero";
                        
                        $rg = @mysqli_query($dbc, $gnr);            
                        while($row =  mysqli_fetch_array($rg, MYSQLI_ASSOC)) {
                            echo '<option value="' .$row['gen_codigo']. '"> ' .$row['gen_descricao']. ' </option>';
                        }
                    ?>
                </select>
                                
                <label>Classificacao</label>
                <select name="fil_classificacao" id="fil_classificacao" class="form-control w-3">                
                    <?php
                        require_once('BD/conecta.php');

                        $clssccc = "select cla_codigo,cla_descricao from Classificacao";

                        $rc = @mysqli_query($dbc, $clssccc);
                        while($row2 = mysqli_fetch_array($rc,MYSQLI_ASSOC)) {
                            echo '<option value="' .$row2['cla_codigo']. '"> '. $row2['cla_descricao'] .' </option>';
                        }
                    ?>     
                </select>    
                                
                <label>Distribuidora</label>
                <select name="fil_distribuidora" id="fil_distribuidora" class="form-control w-3">                
                    <?php 
                        require_once('BD/conecta.php');

                        $dstrbdr = "select dis_codigo,dis_nomefantasia from Distribuidora";
                        
                        $rds = @mysqli_query($dbc, $dstrbdr);
                        while($r3 = mysqli_fetch_array($rds,MYSQLI_ASSOC)) {
                            echo '<option value="' . $r3['dis_codigo'] . '"> ' . $r3['dis_nomefantasia'] . ' </option>';
                        }
                    ?>
                </select>
                                    
                <?php 
                    require_once('BD/conecta.php');

                    $gen = '';                
                    $class = '';                
                    $distri = '';

                    if (!empty($_POST['fil_genero'])) {
                        $gen = mysqli_real_escape_string($dbc, trim($_POST['fil_genero']));
                    }
            
                    if (!empty($_POST['fil_classificacao'])) {
                        $class = mysqli_real_escape_string($dbc, trim($_POST['fil_classificacao']));
                    }
            
                    if (!empty($_POST['fil_distribuidora'])) {
                        $distri = mysqli_real_escape_string($dbc, trim($_POST['fil_distribuidora']));
                    }

                    echo '<script>document.getElementById("fil_genero").value = "' . $gen . '";</script>';
                    echo '<script>document.getElementById("fil_classificacao").value = "' . $class . '";</script>';
                    echo '<script>document.getElementById("fil_distribuidora").value = "' . $distri . '";</script>';
                ?>
	    </div>	   
 		<input type="hidden" name="enviou" value="True" />
	</form>
</div>	
</div>
</div>
</div>

<?php include_once('includes/rodape.php'); ?>