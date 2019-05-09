<?php
    include_once("conecta.php");
    session_start();   

    $com_cod = $_GET["com_cod"];
    $usu_id = $_SESSION['usu_id'];
     
    
    $q_slt_cmt = "Select * From Comentario Where Com_Codigo = $com_cod;";
    $res_slt_cmt = mysqli_query($dbc, $q_slt_cmt);
    $cmt = mysqli_fetch_assoc($res_slt_cmt);

    $fil_id = $cmt["Com_Filme"];

    if($usu_id == $cmt["Com_Usuario"]){
        $q_slt_cmt = "Delete From Comentario Where Com_Codigo = $com_cod;";

        if(mysqli_query($dbc, $q_slt_cmt)){
            echo "Comentário excluido!";
        }else{
            echo "Erro ao excluir comentário";
        }

    }else{
        echo "Você não é o autor desse comentário!";
    }

    mysqli_free_result($res_slt_cmt);
    mysqli_close($dbc);
    header("Location: ../filme.php?id=$fil_id");
?>