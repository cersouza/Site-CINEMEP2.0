<?php 

include_once("includes/cabecalho.php"); 
$erro = "";

    if(isset($_POST['usr'])){        
        include_once("BD/autentica.php");
    }

?>	

    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center align-items-center p-5" style="height:42rem;"> 
                <div class="card w-50">
                    <div class="card-header text-center"><h1 class="card-title">Login</h1></div>
                    <div class="card-body text-left">
                        <?php                      
                        if($erro != "") echo "<div class='alert alert-danger text-center' role='alert'>
                        
                         $erro <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                               </button></div>";?>

                        <form class="form-group" action="login.php" method="POST">
                            <label for="inp_usr">Email:</label>
                            <input type="text" class="form-control mb-3" name="usr" id="inp_usr" placeholder="Digite seu email" value="<?php if($erro != '') echo $usr;?>">
                            <label for="inp_pss">Senha:</label>
                            <input type="password" class="form-control mb-3" name="pss" id="inp_pss" placeholder="Digite sua senha">
                            <input type="submit" class="form-control btn btn-primary" value="Logar">
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <!-- a class="card-link" href="#">Esqueceu a Senha?</a -->
                        <a class="card-link" href="cadastro.php">Cadastrar-se</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

if(isset($_POST['usr'])){ 
    mysqli_free_result($res_login);
    mysqli_close($dbc);
}

include_once("includes/rodape.php"); ?>