<?php
	include_once("cabecalho-novo.php");
	require_once("BD/conecta.php");

	$filme_id = $_GET["id"];
	
	$query = "Select * from Filmes F
		  inner join Genero G on (F.Fil_Genero = G.Gen_Codigo)
		  inner join Classificacao C on (F.Fil_Classificacao = C.Cla_Codigo)
		  inner join Distribuidora D on (F.Fil_Distribuidora = D.Dis_Codigo)
		  Where F.Fil_Codigo=".$filme_id.";";

	$result = mysqli_query($dbc, $query);

	if(mysqli_num_rows($result) == 0)
	{
		echo "Filme não encontrado";
	}else
	{
		//início else
			$filme = mysqli_fetch_assoc($result);

			$fttl = $filme["Fil_Titulo"];
			$fsnp = $filme["Fil_Sinopse"];
			$ffto = $filme["Fil_Foto"];
			
			//Depois de setar as configurações de Data em "cabecalho.php", convertendo data	
			$flnc = strftime('%e de %B de %Y.', strtotime($filme["Fil_Lancamento"]));
				
			

			$ftmp = $filme["Fil_Tempo"];
			$fgnr = $filme["Fil_Genero"];
			$fclss = $filme["Fil_Classificacao"]; 
			$fdst = $filme["Fil_Distribuidora"];  


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
											<tr><th>Nota Usuários:</th><td><h1 class="text-warning d-inline">***</h1></h1 class="text-muted d-inline"> - Regular<h1></td></tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				
				<div class="card bg-light">
					<div class="card-header text-primary"><h2 class="card-title">Comentários</h2></div>
					<div class="card-body">			

						<!-- Criando um Bloco para comentários (.cards) -->
						<div class="card-columns bg-light">
							
							<?php for($x = 0; $x < 4; $x++){?>

							<div class="card bg-class">
								<div class="card-body">	
								<h2 class="card-title text-warning d-inline">***</h2>
								<h3 class="card-subtitle text-muted d-inline"> - Muito Bom!</h3>				
									<blockquote class="blockquote mb-0">
										<p>Eu gostei muito do filme, recomendo!!</p>
										<footer class="blockquote-footer">
											J. Claudiano<cite title="Título da fonte">, 12 Abr</cite>									
										</footer>
									</blockquote>
									<hr>
									<a href="#" class="card-link">Curti!</a>
									<a href="#" class="card-link">Não Gostei!</a>
									<a href="#" class="card-link">Quero Comentar</a>
								</div>
							</div>

							<?php } ?>						
							
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
	} //fim do else

include_once("rodape-novo.php")?>
