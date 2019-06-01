<?php
    require_once("conecta.php");

    $usr = mysqli_real_escape_string($dbc, $_POST["usr"]);
    //$pss = SHA1(mysqli_real_escape_string($dbc, $_POST["pss"]));
    $pss = mysqli_real_escape_string($dbc, $_POST["pss"]);

    
    if(strpos($usr, "@cinemep")){
        $tabela = "Moderador";
        $pref = "Mod";
    }else{
        $tabela = "Usuario";
        $pref = "Usu";
    }
    
    $q_login = "Select * from $tabela Where ".$pref."_Usuario = '$usr' and ".$pref."_Senha = '$pss';";    
    $res_login = mysqli_query($dbc, $q_login);    
    

    if(mysqli_num_rows($res_login) > 0) {
        $usuario = mysqli_fetch_assoc($res_login);

        if ($usuario[$pref.'_Situacao'] == "Ativo"){

            session_start();
            
            $_SESSION['usu_id'] = $usuario[$pref.'_Codigo'];
            $_SESSION['usu_nome'] = $usuario[$pref.'_Nome'];

            //3 - Administrador; 2 - Usuário Comum
            switch($pref){
                case "Mod" : $_SESSION['usu_perfil'] = 3;
                    break;
                case "Usu" : $_SESSION['usu_perfil'] = 2;
                    break;
            }

            header('Location: index.php');
            


        }else{
            $erro = "Sua conta foi Inativada!";
        }       
        
    }else{
        $erro = "Usuário ou senha incorreto(s) !";      
    }
?>