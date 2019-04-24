﻿<?php
	include_once("cabecalho-novo.php");
	require_once("BD/conecta.php");

	//Teste se algum id foi enviado pelo método GET e seu valor é diferente de null
	if((!(isset($_GET["id"]))) || $_GET["id"] == null || is_numeric($_GET["id"]) == false){

		echo "<div class='row'>
				<div class='col-md-12 d-flex justify-content-center align-items-center p-5'>
					<div class='alert alert-danger'>
						<h1><strong>Ops... Erro!</strong></h1>
						<p>
							<strong>Ocorreu o seguinte erro:</strong><br>
							- ID de filme não foi informado ou com valor inválido!<br><br>
							Aguarde... Redirecionando Página!
						</p>
					</div>
				</div>
			</div>";

		//Após três segundos, é redirecionado para a página "lista-filmes.php"
		header("Refresh: 5; url=lista-filmes.php");

	} 
	else{	
	$filme_id = $_GET["id"];
	
	$query_filme = "Select * from Filmes F
		  inner join Genero G on (F.Fil_Genero = G.Gen_Codigo)
		  inner join Classificacao C on (F.Fil_Classificacao = C.Cla_Codigo)
		  inner join Distribuidora D on (F.Fil_Distribuidora = D.Dis_Codigo)
		  Where F.Fil_Codigo=".$filme_id.";";

	$res_filme = mysqli_query($dbc, $query_filme);
	
	//Teste se o filme existe
	if(mysqli_num_rows($res_filme) == 0)
	{
		echo "<div class='row'>
				<div class='col-md-12 d-flex justify-content-center align-items-center p-5'>
					<div class='alert alert-danger'>
						<h1><strong>Ops... Erro!</strong></h1>
						<p>
							<strong>Ocorreu o seguinte erro:</strong><br>
							- Filme não foi encontrado!
						</p>
					</div>
				</div>
			</div>";
	}else
	{
			$filme = mysqli_fetch_assoc($res_filme);

			$fttl = $filme["Fil_Titulo"];
			$fsnp = $filme["Fil_Sinopse"];
			$ffto = $filme["Fil_Foto"];
			
			//Depois de setar as configurações de Data em "cabecalho.php", convertendo data	 
			$flnc = strftime('%e de %B de %Y.', strtotime($filme["Fil_Lancamento"]));
				
			

			$ftmp = $filme["Fil_Tempo"];
			$fgnr = $filme["Fil_Genero"];
			$fclss = $filme["Fil_Classificacao"]; 
			$fdst = $filme["Fil_Distribuidora"];  

			//Calculando Média e Quantidade de Avaliações dos Usuários
			$query_nota = "Select COUNT(Com_Usuario) as 'qtd_avaliacao', AVG(Com_Avaliacao) as 'media_avalicao'
						   from Comentario Where Com_Filme = ".$filme_id."
						   Group by Com_Filme;";

			$res_nota = mysqli_query($dbc, $query_nota);
			$nota_usu = mysqli_fetch_assoc($res_nota);
			$qtd_avaliacao = $nota_usu["qtd_avaliacao"];
			$media_avalicao = round($nota_usu["media_avalicao"], 2); // formatando casas decimais

			//Validando textos a serem exibidos
			$msg_qtd = "Avaliações";
			if ($qtd_avaliacao == 1) $msg_qtd = "Avaliação";

			$ms_nota = "";

			if ($media_avalicao < 2) $ms_nota = " - Péssimo";
			else if ($media_avalicao < 3) $ms_nota = " - Ruim";
			else if ($media_avalicao < 4) $ms_nota = " - Mais ou Menos";
			else if ($media_avalicao < 5) $ms_nota = " - Bom";
			else if ($media_avalicao == 5) $ms_nota = " - Excelente";

?>	
		<div class="row">
			<div class="col-md-12">
				<!-- Criando um Card, definido o paddingY (py - top and bottom) e o paddingX (px - left and right) - CERSZ -->
				<div class="card bg-light">
					<div class="card-header text-primary"><h3 class="card-title text-capitalize"><?php echo $fttl?></h3></div>
					<div class="card-body">

						<div class="row">
							<div class="col-md-4 d-flex justify-content-center align-items-center">
								<img class="rounded" src="img/filmes/capa-capita-marvel.jpg" width="auto" height="400">
							</div>
						
							<div class="col-md-8">
								<table class="table">
									<tbody>
											<tr><th>Título:</th><td><?php echo $fttl?></td></tr>							
											<tr><th>Data Lançamento:</th><td><?php echo $flnc?></td></tr>
											<tr><th>Elenco:</th><td>Brie Larson, Samuel L. Jackson, Jude Law</td></tr>
											<tr><th>Sinopse:</th>
												<td><p><?php echo $fsnp?></p></td>
											</tr>
											<tr><th>Nota Usuários:<br><small class="text-muted"> <?php echo $qtd_avaliacao." ".$msg_qtd; ?></small></th>
												<td><h2 class="text-muted"><span class="text-warning"><?php echo $media_avalicao;?></span><?php echo $ms_nota;?></h2></td></tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				
									
							
						<?php 
							$query_comentario = "Select U.Usu_Nome, C.Com_Comentario, C.Com_Gostou, 
												C.Com_NaoGostou, C.Com_Avaliacao, C.Com_Data from Comentario C
												inner join Usuario U on (C.Com_Usuario = U.Usu_Codigo) Where C.Com_Filme =".$filme_id.";";
							$res_comentario = mysqli_query($dbc, $query_comentario);

							$Qtd_Coment = mysqli_num_rows($res_comentario);

							// Criando um Bloco para comentários (.cards)

							echo "<div class='card bg-light'>
									<div class='card-header text-primary'><h2 class='card-title'>Comentários (".$Qtd_Coment.")</h2></div>
									<div class='card-body'>									
								<div class='card-columns bg-light'>";

							if(mysqli_num_rows($res_comentario) == 0) {
								echo "<h2 class='text-muted'>Seja o primeiro a comentar clicando abaixo!</h2>";
							}else{

								while ($comentarios = mysqli_fetch_assoc($res_comentario)) {

								$com_usu = $comentarios["Usu_Nome"];
								$com_desc = $comentarios["Com_Comentario"];
								
								$com_nota = $comentarios["Com_Avaliacao"];

								switch ($com_nota)
								{
									case 1: $nota_desc = "- Péssimo";
									break;
									case 2: $nota_desc = "- Ruim";
									break;
									case 3: $nota_desc = "- Mais ou Menos";
									break;
									case 4: $nota_desc = "- Bom";
									break;
									case 5: $nota_desc = "- Excelente";
									break;
								}
								$nota = "";

								for($x = 1; $x <= $com_nota; $x++){
									$nota .= "*";
								}


								$com_data = date('d/m/Y\, \à\s H:i\h', strtotime($comentarios["Com_Data"]));
								$com_qtd_like = $comentarios["Com_Gostou"];
								$com_qtd_dislike = $comentarios["Com_NaoGostou"];
								
								echo "
								<div class='card bg-class'>
									<div class='card-body'>	
									<h2 class='card-title text-warning d-inline'>".$nota."</h2>
									<h3 class='card-subtitle text-muted d-inline'>".$nota_desc."</h3>				
										<blockquote class='blockquote mb-0'>
											<p>".$com_desc."</p>
											<footer class='blockquote-footer'>
												".$com_usu."<cite title='Título da fonte'>, ".$com_data."</cite>									
											</footer>
										</blockquote>
										<hr>
										<a href='#' class='card-link'>Curti! (".$com_qtd_like.")</a>
										<a href='#' class='card-link'>Não Gostei! (".$com_qtd_dislike.")</a>
										<a href='#' class='card-link'>Quero Comentar</a>
									</div>
								</div>";
									
								}
							}?>						
							
						</div>
						<!-- fim .card-columns -->

						<div class="card bg-light">
								<div class="card-header text-center">
									<h3 class="card-title">Adicionar Comentário</h3>
									<button class="btn btn-primary" data-toggle="collapse" data-target="#frm-comentario">Comentar</button>
								</div>
								<div class="card-body collapse" id="frm-comentario">									
									<form class="form-group" method="POST" action="#">
										<label for="nota">Nota:</label>
										<select class="form-control w-50" id="nota">
											<option>1 - Péssimo</option>
											<option>2 - Ruim</option>
											<option>3 - Mais ou Menos</option>
											<option>4 - Bom</option>
											<option>5 - Excelente</option>
										</select>

										<label for="comment">Comentário:</label>
										<textarea class="form-control" rows="5" id="comment"  name="comentario" placeholder="Digite seu comentário aqui..."></textarea><br>
										<input class="btn btn-primary" type="submit" value="Publicar">
									</form>
								</div>
							</div>

					</div>
				</div>

			</div>
		</div>	
<?php
		} //fim do else para Filme Encontrado
	} //fim do else para GET["id"] encontrado e diferente de null
include_once("rodape-novo.php")?>