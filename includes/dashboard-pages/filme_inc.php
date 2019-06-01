<?php 
	include_once('includes/cabecalho.php');
    require_once('BD/conecta.php');
    
	if (isset($_POST['enviou']))
	{
		
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

        if (empty($_POST['fil_url'])) {
	        $url = '';
		} else {
			$url = mysqli_real_escape_string($dbc, trim($_POST['fil_url']));
        }

        $location = 'img/cartaz/';

        if (isset($_FILES['foto'])) {
            if ($_FILES['foto']['tmp_name'] == '') {
                $erros[] =  "Você esqueceu de informar o cartaz.";
            } else {
                
                if (empty($_POST['Fil_Titulo'])) {
                    $name = $_FILES['foto']['name'];
                } else {
                    $name = $_POST['Fil_Titulo'] . '.' . pathinfo($tmp_name, PATHINFO_EXTENSION);  ;                 
                }
                
                $tmp_name = $_FILES['foto']['tmp_name'];

                $error = $_FILES['foto']['error'];
                if ($error !== UPLOAD_ERR_OK) {
                    $erros[] =  'Erro ao fazer o upload: '. $error;
                } else { 
                    move_uploaded_file($tmp_name, $location . $name);
                }

                $novoDestino = $location . $name;
            }
        } else {
            $erros[] =  "Você esqueceu de informar o cartaz.";
        }

        if (isset($_FILES['wall'])) {
            if ($_FILES['wall']['tmp_name'] != '') {
                $locationwall = 'img/wallpaper/';

                if (empty($_POST['Fil_Titulo'])) {
                    $namewall = $_FILES['wall']['name'];
                } else {
                    $namewall = $_POST['Fil_Titulo'] . '.' . $_FILES['wall']['type'];                 
                }
                
                $tmp_namewall = $_FILES['wall']['tmp_name'];

                $error = $_FILES['wall']['error'];
                if ($error !== UPLOAD_ERR_OK) {
                    $erros[] =  'Erro ao fazer o upload: '. $error;
                } else { 
                    move_uploaded_file($tmp_namewall, $locationwall . $namewall);
                }

                $destinoWall = $locationwall . $namewall;
            }
        }

		//Verifica se há erros
		if (empty($erros))
		{
            //SQL de inserção
			$q = "INSERT INTO filmes(Fil_Titulo,Fil_Sinopse,Fil_Foto,Fil_Lancamento,Fil_Tempo,Fil_Genero,Fil_Classificacao,Fil_Distribuidora,Fil_Situacao,fil_url,fil_wall)
				VALUES ('$titulo','$sinopse','$novoDestino','$lancamento','$tempo',$genero,$classificacao,$distribuidora,'Ativo','$url','$destinoWall')";
                
			$r = @mysqli_query($dbc, $q);
			if ($r)
			{
			    $sucesso = "<h1><strong>Sucesso!</strong></h1>
			    <p>Seu registro foi incluido com sucesso!</p>
			    <p>Aguarde... Redirecionando!</p>";
			    echo "<meta HTTP-EQUIV='refresh' 
                CONTENT='3;URL=dashboard.php?tb=filme&op=menu'>";
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

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Cadastro de Filme</h1>
			
	<?php
		if	(isset($erro))
			echo "<div class='alert alert-danger'>$erro</div>";
			
		if	(isset($sucesso))
			echo "<div class='alert alert-success'>$sucesso</div>";
	?> 

	<form enctype="multipart/form-data" method="post" action="dashboard.php?tb=filme&op=inc">
			
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

                <label>Cartaz</label>
                <input type="file" name="foto" class="form-control" 
                    accept=".jpeg,.jpg,.gif,.png,.bitmap"/>   

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

                        $gnr = "select gen_codigo,gen_descricao from genero";
                        
                        $rg = @mysqli_query($dbc, $gnr);            
                        while($row =  mysqli_fetch_array($rg, MYSQLI_ASSOC)) {
                            echo '<option value="' .$row['gen_codigo']. '"> ' .$row['gen_descricao']. ' </option>';
                        }
                    ?>
                </select>
                                
                <label>Classificacao</label>
                <select name="fil_classificacao" id="fil_classificacao" class="form-control w-3">                
                    <?php
                        

                        $clssccc = "select cla_codigo,cla_descricao from classificacao";

                        $rc = @mysqli_query($dbc, $clssccc);
                        while($row2 = mysqli_fetch_array($rc,MYSQLI_ASSOC)) {
                            echo '<option value="' .$row2['cla_codigo']. '"> '. $row2['cla_descricao'] .' </option>';
                        }
                    ?>     
                </select>    
                                
                <label>Distribuidora</label>
                <select name="fil_distribuidora" id="fil_distribuidora" class="form-control w-3">                
                    <?php 
                        

                        $dstrbdr = "select dis_codigo,dis_nomefantasia from distribuidora";
                        
                        $rds = @mysqli_query($dbc, $dstrbdr);
                        while($r3 = mysqli_fetch_array($rds,MYSQLI_ASSOC)) {
                            echo '<option value="' . $r3['dis_codigo'] . '"> ' . $r3['dis_nomefantasia'] . ' </option>';
                        }
                    ?>
                </select>

                <label>WallPaper</label>
                <input type="file" name="wall" class="form-control" 
                    accept=".jpeg,.jpg,.gif,.png,.bitmap"/> 
                
                <label>URL</label>
                <input type="url" name="fil_url" class="form-control"
                    placeholder="Digite a url" value="<?php if (isset($_POST['fil_url']))
                    echo $_POST['fil_url']; ?>"/>

                <?php 
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

<?php include_once('includes/rodape.php'); ?>