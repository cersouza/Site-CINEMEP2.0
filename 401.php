<?php include_once("includes/cabecalho.php"); ?>	

    
        <div class='row'>
				<div class='col-md-12 d-flex justify-content-center align-items-center p-5'>
					<div class='alert alert-danger text-center'>
						<h1><strong>Permissão Negada!</strong></h1>
						<p>Você não tem permissão para acessar essa página!<br>
                        Redirecionando...
						</p>
					</div>
				</div>
			</div>
    

<?php 
header("Refresh:3; url=index.php");
include_once("includes/rodape.php"); ?>
