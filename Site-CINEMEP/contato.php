<?php 
	if(count($_POST) > 0){
		$nome  = $_POST['nome'];
		$email  = $_POST['email'];
		$comentario  = $_POST['comentario'];
		$enviou = $_POST["enviou"];
	}
	
	$pag1 = '#';
	$pag2 = '#';
	$pag3 = '#';
	$pag4 = "ativado";
	include('cabecalho.php');
?>
<section class='fullscreen center'>		
		<?php
		date_default_timezone_set('America/Sao_Paulo');
		
		if(!count($_POST) > 0){
			echo "<div class='left'>
				<h2>ENTRE EM CONTATO CONOSCO</h2>
				<p><strong>Telefone:</strong> (19) 99999-9999<br><strong>Email:</strong> contato@cinemep.com<br><strong>Endereço:</strong> Av. Claudiano é Legal, 10, Bairro CECAP, Piracicaba - SP.</p>
				</div>
			<div class='formulario'>				
				<form id='form-cad' method='post'>
					<input type='text' placeholder='Seu Nome' name='nome' class='borda'>
					<input type='email' placeholder='Seu Email' name='email' class='borda'>
					<textarea name='comentario' form='form-cad' rows='7' maxlength='200'  placeholder='Deixe sua mensagem aqui' class='borda'></textarea>
					<input type='submit' value='ENVIAR' class='button'>
					<input type='hidden' name='enviou' value='sim'>
				</form>		
			</div>";
		}
		else{
			echo "<div class='formulario-resposta'>
					<h1>:(</h1><h2>Desculpe pelo transtorno <strong>$nome</strong>,</h2>
					<p>Estamos desenvolvendo o nosso banco de dados e por isso ainda não podemos te dar um retorno, mas a sua mensagem foi registrada e assim que
					possível estaremos te retornando no seu email: <strong>$email</strong> <br><br>
					MENSAGEM:<br><br>
					<em>\"$comentario\"<em><br>
					$nome, " .  date('d/m/Y H:i') . ".</p> </div>";	
		}
		?>
</section>
<?php include('rodape.php')?>
