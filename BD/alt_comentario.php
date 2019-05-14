<?php
    include_once("conecta.php");

    session_start();
    $erro = "";
    
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');

    $com_cod = $_POST['com_cod'];
    $fil_id = mysqli_real_escape_string($dbc, $_POST["fil_id"]);
    $nota = mysqli_real_escape_string($dbc,$_POST["nota_fil"]);
    $comentario = mysqli_real_escape_string($dbc,$_POST["comentario"]);   
    
    $data_com = strftime('%Y-%m-%d %H:%M:%S');

    if(!(isset($_SESSION['usu_id']))){
        echo "Necessário logar!";                     
    }
    else{  

        $usu_id = $_SESSION['usu_id'];
       

        $ins_cmt = "Update Comentario Set Com_Comentario = '$comentario', Com_Avaliacao = $nota, Com_Filme = $fil_id, Com_Data = '$data_com' 
                    Where Com_Codigo = $com_cod and Com_Usuario = $usu_id;";
                    
        if(mysqli_query($dbc, $ins_cmt)){
            echo "Avaliação Alterada!";
            header("Refresh: 3; url=../filme.php?id=$fil_id");                
        }else{
            echo "Houve problemas para inserção";
        }

        

    }

    mysqli_close($dbc);
?>
