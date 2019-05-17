<?php
	//Setando o título da página
	//$titulo_pagina = $fttl; (?) - Como fazer? - CERS
		
	include_once("includes/cabecalho.php");
	//Bloco de funções para a página
	include_once("includes/funcoes.php");
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

			//Puxando Info. Atores do Filme
			$query_atores = "Select A.Atr_Nome as 'atr_nome', F.Atfl_Papel as 'atr_papel'
			From AtorFilme F inner join Ator A on (F.Atfl_Atr_Codigo = A.Atr_Codigo)
			Where F.Atfl_Fil_Codigo =".$filme_id."
			Order by F.Atfl_Importancia;";

			$res_atores = mysqli_query($dbc, $query_atores);
			
			//mensagens
			if ((isset($_GET["tipo"])) and (isset($_GET["msg"]))){
				show_msg($_GET["tipo"], $_GET["msg"]);
			}

?>	
		<div class="row">
			<div class="col-md-12">
				<!-- Criando um Card, definido o paddingY (py - top and bottom) e o paddingX (px - left and right) - CERSZ -->
				<div class="card bg-light">
					<div class="card-header text-primary"><h3 class="card-title text-capitalize"><?php echo $fttl; ?></h3></div>
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
											<tr><th>Elenco:</th>
												<td>
												<?php 
													//se houver mais de um ator cadastrado, será separado por virgulas
													$str = "";													

													while($fil_atores = mysqli_fetch_assoc($res_atores))
													{
														echo $str . "<a href='https://www.google.com/search?q=". $fil_atores['atr_nome']. "' target='_blank'>" . $fil_atores['atr_nome'] . ' (' . $fil_atores['atr_papel'] . ')</a>';
														$str = ", ";
													}
													
													echo ".";
												?>
												</td>
											</tr>
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

							//Puxando Comentários
							$query_comentario = "Select C.Com_Usuario, C.Com_Codigo, U.Usu_Nome, C.Com_Comentario, C.Com_Gostou, 
												C.Com_NaoGostou, C.Com_Avaliacao, C.Com_Data from Comentario C
												inner join Usuario U on (C.Com_Usuario = U.Usu_Codigo) Where C.Com_Filme =".$filme_id.";";
							$res_comentario = mysqli_query($dbc, $query_comentario);

							$Qtd_Coment = mysqli_num_rows($res_comentario);

							// Criando um Bloco para comentários (.cards)

							echo "<div class='card bg-light' id='bloco_cmt'>
									<div class='card-header text-primary'><h2 class='card-title'>Avaliações (".$Qtd_Coment.")</h2></div>
									<div class='card-body'>									
								<div class='card-columns bg-light'>";

							if(mysqli_num_rows($res_comentario) > 0) {
								echo "<div class='text-center m-3'><h2 class='text-muted'>Seja o primeiro a comentar clicando abaixo!</h2></div>";								
							}else{

								while ($comentarios = mysqli_fetch_assoc($res_comentario)) {

								$com_cod = $comentarios["Com_Codigo"];
								$com_usu_id = $comentarios["Com_Usuario"];
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
								
								//Contando Likes
								$q_qtd_like = "Select Count(Rc_usuario) as 'qtd_like' From ReacaoComentario Where Rc_Comentario = $com_cod and Rc_like = 'True';";
								
								if(mysqli_query($dbc, $q_qtd_like))
								{
									$res_qtd_like = mysqli_query($dbc, $q_qtd_like);
									$like = mysqli_fetch_assoc($res_qtd_like);

									$com_qtd_like = $like["qtd_like"];
								}
								
								//Contando Dislikes
								$q_qtd_dislike = "Select Count(Rc_usuario) as 'qtd_dislike' From ReacaoComentario Where Rc_Comentario = $com_cod and Rc_Dislike = 'True';";
								
								if(mysqli_query($dbc, $q_qtd_dislike))
								{
									$res_qtd_dislike = mysqli_query($dbc, $q_qtd_dislike);
									$dislike = mysqli_fetch_assoc($res_qtd_dislike);

									$com_qtd_dislike = $dislike["qtd_dislike"];
								}								
								
								if (!(isset($com_qtd_like))) $com_qtd_like = 0;
								if (!(isset($com_qtd_dislike))) $com_qtd_dislike = 0;
								
								echo "
								<div class='card bg-class'>
									<div class='card-body'>	
									<h2 class='card-title text-warning d-inline'>$nota</h2>
									<h3 class='card-subtitle text-muted d-inline'>$nota_desc</h3>";
									
								if($usu_id == $com_usu_id){
									//Criando um Dropdown Menu para cada comentário segundo seu Código
									echo "<div class='dropright'>
											<button type='button' class='btn btn-secondary dropdown-toggle' id='opComentario".$com_cod."' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>+</button>
											<div class='dropdown-menu' aria-labelledby='opComentario$com_cod'>
												<button type='button' class='dropdown-item' data-toggle='modal' data-target='#mdl_confAlt".$com_cod."'>Editar</button>
													".mdl_altComentario($filme_id, $com_nota, $com_cod, $com_desc)."
												<button type='button' class='dropdown-item' data-toggle='modal' data-target='#mdl_confExc".$com_cod."'>Excluir</button>
													".mdl_excComentario($com_cod)."
											</div>
										</div>";
								}

								echo "<blockquote class='blockquote mb-0'>
											<p>$com_desc</p>
											<footer class='blockquote-footer'>
												$com_usu<cite title='Título da fonte'>, $com_data</cite>									
											</footer>
											</blockquote>
										<hr>
										<a href='BD/curtirComentario.php?fil_id=$filme_id&com_cod=$com_cod' class='card-link'>Curti! ($com_qtd_like)</a>
										<a href='BD/descurtirComentario.php?fil_id=$filme_id&com_cod=$com_cod' class='card-link'>Não Gostei! ($com_qtd_dislike)</a>
									</div>
								</div>";
									
								}
							}?>						
							
						</div>
						<!-- fim .card-columns -->

						<div class="card bg-light">
								<div class="card-header text-center">
									<h3 class="card-title">Adicionar Avaliação</h3>
									<button class="btn btn-primary" data-toggle="collapse" data-target="#frm-comentario">Comentar</button>
								</div>
								<div class="card-body collapse" id="frm-comentario">									
									<form class="form-group" method="POST" action="BD/cad_comentario.php">
										<label for="nota">Avaliação:</label>
										<select name="nota_fil" class="form-control w-50" id="nota">
											<option value="1">1 - Péssimo</option>
											<option value="2">2 - Ruim</option>
											<option value="3">3 - Mais ou Menos</option>
											<option value="4">4 - Bom</option>
											<option value="5">5 - Excelente</option>
										</select>

										<label for="comment">Comentário:</label>
										<textarea class="form-control" rows="5" id="comment"  name="comentario" placeholder="Digite seu comentário aqui..."></textarea><br>

										<input type="hidden" name="fil_id" value="<?echo $filme_id; ?>">										
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

	mysqli_free_result($res_atores);
	mysqli_free_result($res_comentario);
	mysqli_free_result($res_filme);
	mysqli_free_result($res_nota);

	mysqli_close($dbc);
	
include_once("includes/rodape.php"); ?>

