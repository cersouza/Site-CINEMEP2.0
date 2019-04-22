<?php
	include_once("cabecalho-novo.php");
?>	
		<div class="row">
			<div class="col-md-12">
				<!-- Criando um Card, definido o paddingY (py - top and bottom) e o paddingX (px - left and right) - CERSZ -->
				<div class="card bg-light">
					<div class="card-header text-primary"><h3 class="card-title">Capitã Marvel</h3></div>
					<div class="card-body">

						<div class="row">
							<div class="col-md-4 d-flex justify-content-center align-items-center">
								<img class="rounded" src="img/filmes/capa-capita-marvel.jpg" width="auto" height="400">
							</div>
						
							<div class="col-md-8">
								<table class="table">
									<tbody>
											<tr><th>Título:</th><td>Capitã Marvel</td></tr>							
											<tr><th>Data Lançamento:</th><td>7 de março de 2019 (2h 04min)</td></tr>
											<tr><th>Elenco:</th><td>Brie Larson, Samuel L. Jackson, Jude Law</td></tr>
											<tr><th>Sinopse:</th>
												<td><p>
													Carol Danvers (Brie Larson) é uma ex-agente da Força Aérea norte-americana, que, 
													sem se lembrar de sua vida na Terra, é recrutada pelos Kree para fazer parte de seu exército de elite. 
													Inimiga declarada dos Skrull, ela acaba voltando ao seu planeta de origem para impedir uma invasão dos
													metaformos, e assim vai acabar descobrindo a verdade sobre si, com a ajuda do agente
													Nick Fury (Samuel L. Jackson) e da gata Goose.
												</p></td>
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
<?php include_once("rodape-novo.php")?>
