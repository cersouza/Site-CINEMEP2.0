<?php
    include_once("conecta.php");

    session_start();
    $erro = "";
    
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');

    $fil_id = mysqli_real_escape_string($dbc, $_POST["fil_id"]);
    $nota = mysqli_real_escape_string($dbc,$_POST["nota_fil"]);
    $comentario = mysqli_real_escape_string($dbc,$_POST["comentario"]);   
    
    $data_com = strftime('%Y-%m-%d %H:%M:%S');

    if(!(isset($_SESSION['usu_id']))){
        echo "Necessário logar!";                     
    }
    else if($_SESSION['usu_perfil'] == 3){
        echo "Me desculpe, de acordo com as regras da empresa Contas Moderadores não podem interagir com os Filmes!<br>Redirecionando...";
        header("Refresh: 3; url=../lista-filmes.php");
    }
    else{  

        $usu_id = $_SESSION['usu_id'];

        $q_existe_cmt = "Select * From Comentario Where Com_Usuario = $usu_id;";
        $res_existe_cmt = mysqli_query($dbc, $q_existe_cmt);
        

        if(mysqli_num_rows($res_existe_cmt) > 0){

            echo "Você já fez sua avaliação, deseja editá-la?";
            mysqli_free_result($res_existe_cmt);

        }else{

            $ins_cmt = "Insert Into Comentario (Com_Usuario, Com_Comentario, Com_Gostou, Com_NaoGostou, Com_Avaliacao, Com_Filme, Com_Data, Com_Situacao) 
            Values ($usu_id, '$comentario', 0, 0, $nota, $fil_id, '$data_com', 'T');";
                        
            if(mysqli_query($dbc, $ins_cmt)){
                header("Location: ../filme.php?id=$fil_id&tipo=success&msg=1");                  
            }else{
                header("Location: ../filme.php?id=$fil_id&tipo=error&msg=1");  
            }

        }

    }

    mysqli_close($dbc);
?>
