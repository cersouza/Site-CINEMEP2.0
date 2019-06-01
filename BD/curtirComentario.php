<?php
    include_once("conecta.php");

    session_start();

    if(!(isset($_SESSION['usu_id']))){
        echo "Necessário logar!";                    
    }
    else if($_SESSION['usu_perfil'] == 3){
        echo "Me desculpe, de acordo com as regras da empresa Contas Moderadores não podem interagir com os Filmes!<br>Redirecionando...";
        header("Refresh: 3; url=../lista-filmes.php");
    }
    else{  

        $usu_id = $_SESSION['usu_id'];
        $com_cod = $_GET['com_cod'];
        $fil_id = $_GET['fil_id'];

        $q_curtido = "Select * From ReacaoComentario Where Rc_Usuario = $usu_id and Rc_Comentario = $com_cod;";
        $res_curtido = mysqli_query($dbc, $q_curtido);
        

        if(mysqli_num_rows($res_curtido) > 0){

            $reacao = mysqli_fetch_assoc($res_curtido);
            $q_reacao = "";

            if($reacao['Rc_like'] == 'True'){
                $q_reacao = "Update ReacaoComentario set Rc_like = 'False' Where Rc_Usuario = $usu_id and Rc_Comentario = $com_cod;";
            }else{
                $q_reacao = "Update ReacaoComentario set Rc_like = 'True', Rc_Dislike = 'False' Where Rc_Usuario = $usu_id and Rc_Comentario = $com_cod;";
            }

            if ($q_reacao != ""){

                if(mysqli_query($dbc, $q_reacao)){                    
                    header("Location: ../filme.php?id=$fil_id");                  
                }else{
                    echo "Deu ruim ao Curtir (Já cadastrado)";
                }

            }

            
            mysqli_free_result($res_curtido);

        }else{

            $ins_reacao = "Insert Into ReacaoComentario (Rc_Usuario, Rc_Comentario, Rc_like, Rc_Dislike) 
            Values ($usu_id, $com_cod, 'True', 'False');";
                        
            if(mysqli_query($dbc, $ins_reacao)){
                header("Location: ../filme.php?id=$fil_id");                  
            }else{
                echo "Deu ruim ao Curtir (Ainda não Cadastrado)";  
            }

        }

    }
?>