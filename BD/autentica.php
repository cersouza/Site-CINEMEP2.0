<?php
    require_once("conecta.php");

    $usr = mysqli_real_escape_string($dbc, $_POST["usr"]);
    //$pss = SHA1(mysqli_real_escape_string($dbc, $_POST["pss"]));
    $pss = mysqli_real_escape_string($dbc, $_POST["pss"]);

    $q_login = "Select * from Usuario Where Usu_Usuario = '$usr' and Usu_Senha = '$pss';";
    $res_login = mysqli_query($dbc, $q_login);    
    

    if(mysqli_num_rows($res_login) > 0) {
        $usuario = mysqli_fetch_assoc($res_login);

        if ($usuario['Usu_Situacao'] == "Ativo"){

            session_start();
            
            $_SESSION['usu_id'] = $usuario['Usu_Codigo'];
            $_SESSION['usu_nome'] = $usuario['Usu_Nome'];

            header('Location: index.php');


        }else{
            $erro = "Sua conta foi Inativada!";
        }       
        
    }else{
        $erro = "Usuário ou senha incorreto(s) !";      
    }
?>