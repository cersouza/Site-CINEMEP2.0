<?php 
	include_once('includes/cabecalho.php');
	require_once('BD/conecta.php');
	
	$exiba = 10;
	
	$where = mysqli_real_escape_string($dbc, trim(isset($_GET['q'])) ? $_GET['q'] : '');
	
	if (isset($_GET['fil']) && is_numeric($_GET['fil'])) {
		$fil = $_GET['fil'];
	} else {
		header("Location: dashboard.php?tb=atorfilme&op=menu");
		exit();	
	}
	
	if 	(isset($_GET['p']) && is_numeric($_GET['p']))
	{
		$pagina = $_GET['p'];
	} else {
		$sql = "SELECT COUNT(Atfl_Codigo) FROM AtorFilme 
				inner join ator on (Atfl_Atr_Codigo = atr_codigo) 
				WHERE and atfl_fil_codigo = $fil and Atr_Nome like '%$where%'";
		$r = @mysqli_query($dbc, $sql);
		$row = @mysqli_fetch_array($r, MYSQLI_NUM);
		$qtde = $row[0];
    
		if ($qtde > $exiba) {
			$pagina = ceil($qtde/$exiba);
		} else {
			$pagina = 1;
		}
	}
	
	if (isset($_GET['s']) && is_numeric($_GET['s'])) {
		$inicio = $_GET['s'];
	} else {
		$inicio = 0;
	}
	
	$ordem = isset($_GET['ordem']) ? $_GET['ordem'] : 'nom';
	  
	switch ($ordem)
	{
        case 'cod' :
            $order_by = 'atfl_codigo';
            break;    
		case 'nom' :
			$order_by = 'atr_nome';
			break;
		case 'pap' :
			$order_by = 'atfl_papel';
            break;	  
		default:
		    $order_by = 'fil_titulo';
			$ordem = 'tit';
			break;
	}
	
	$q = "SELECT atfl_codigo, atr_nome, atfl_papel FROM AtorFilme 
		  INNER JOIN Ator on (atr_codigo = atfl_atr_codigo)
		  WHERE (atr_nome like '%$where%') and (atfl_fil_codigo = $fil) ORDER BY $order_by
		  LIMIT $inicio, $exiba";

	$r = @mysqli_query($dbc, $q);
	if (mysqli_num_rows($r) > 0)
	{
		$saida = "<div class='table-responsive col-md-12'>
		<table class='table table-striped'>
		<thead>
			<tr>
				<th width='10%'>
				<a href='dashboard.php?tb=atorfilme&op=menu&fil= " . $fil . "&ordem=cod'>
                Código</a></th>
                <th width='40%'>
				<a href='dashboard.php?tb=atorfilme&op=menu&fil= " . $fil . "&ordem=nom'>
				Nome</a></th>
				<th width='30%'>
				<a href='dashboard.php?tb=atorfilme&op=menu&fil= " . $fil . "&ordem=pap'>
				Papel</a></th>
				<th width='30%'>Ações</th>
			</tr>
		</thead>
		<tbody>";
		while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
		{
			$saida .= "<tr>
			<td>" . $row['atfl_codigo'] . "</td> 
			<td>" . $row['atr_nome'] . "</td>
			<td>" . $row['atfl_papel'] . "</td>
			<td class='actions'>
			<a href='dashboard.php?tb=atorfilme&op=alt&id=" . $row['atfl_codigo'] ."' class='btn btn-xs btn-warning'>Editar</a>
            <a href='dashboard.php?tb=atorfilme&op=exc&id=" . $row['atfl_codigo'] ."' class='btn btn-xs btn-danger'>Excluir</a>
			</td></tr>";		
		}
		$saida .= "</tbody></table></div>";
	}
	else
	{
		if ($where == "") {
			$saida = "<div class='alert alert-warning'>Não foi encontrado nenhum registro.<br /></div>";
		} else {	
			$saida = "<div class='alert alert-warning'>Sua pesquisa por <strong>$where</strong> não encontrou nenhum registro.<br />";
			$saida .= "<strong>Dicas</strong><br />";
			$saida .= "- Tente palavras menos especificas.<br />";
			$saida .= "- Tente palavras chaves diferentes.<br />";
			$saida .= "- Confira a ortografia das palavras e se elas foram acentuadas corretamentes.<br /></div>";
		}  
	}
	
	if ($pagina > 1)
	{
		$pag = '';
		$pagina_correta = ($inicio/$exiba) + 1;
		
		if ($pagina_correta != 1)
		{
			$pag .= "<li class='prior'>
			<a href='dashboard.php?tb=atorfilme&op=menu&fil=" . $fil . "&s=" . ($inicio - $exiba) .
			"&p=" . $pagina . 
			"&ordem=" . $ordem . "'>Anterior</a></li>";
		} else
		{
			$pag .= "<li class='disabled'><a>Anterior</a></li>";
		}
		
		for ($i = 1; $i <= $pagina; $i++)
		{
			if ($i != $pagina_correta)
			{
				$pag .= "<li><a href='dashboard.php?tb=atorfilme&op=menu&fil=" . $fil . "&s="
				. ($exiba * ($i - 1)) . "&p=" .
				$pagina . "&ordem=" . $ordem . "'>" . $i . "</a></li>";
			}
			else
			{
				$pag .= "<li class='disabled'><a>"
				. $i . "</a></li>";
			}
		}
		
		if ($pagina_correta != $pagina)
		{
			$pag .= "<li class='next'>
			<a href='dashboard.php?tb=atorfilme&op=menu&fil=" . $fil . "&s="
			. ($inicio + $exiba) .
			"&p=" . $pagina . "&ordem=" . $ordem . "'>Próximo</a></li>";
		}
		else
		{
			$pag .= "<li class='disabled'><a>Próximo</a></li>";
		}
	}
?>	

<div class="col-sm-9 col-sm-offset-3 col-md-12 col-md-offset-2 main">
<div class="row">
	<div class="col-md-3 mt-3"><h2>Ator por filme</h2></div>
	<div class="col-md-6 mt-3">	
		<div class="input-group h2">
			<input class="form-control" id="busca"
				type="text" 
				placeholder="Pesquisa de Ator por Nome" />
			<span class="input-group-btn">
			   <a href="#" onclick="this.href='dashboard.php?tb=atorfilme&op=menu&fil=' . $fil . '&q='+
			   document.getElementById('busca').value"
			   class="btn btn-primary">
			   <img class="d-inline-block align-center" src="img/find.png" width="25" height="25">
			   </a>
			</span>
		</div>
	</div>
	
	<div class="col-md-3 mt-3">
		<?php $href = "dashboard.php?tb=atorfilme&op=inc&fil=" . $fil;
		?>
		<a href="<?php echo $href?>" 
			class="btn btn-primary pull-right h2">
			Inserir Ator</a>
	</div>
</div>			

	<hr />
	
	<div id="list" class="row">
		<?php echo $saida; ?>
	</div>
	
	<div id="button" class="row">
		<ul class="pagination">
			<?php if (isset($pag)) echo $pag; ?>
		</ul>
	</div>
			
</div>
</div>
</div>
		  
<?php include_once('includes/rodape.php'); ?>