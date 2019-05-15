<?php
    include_once("conecta.php");

    session_start();

    if(!(isset($_SESSION['usu_id']))){
        echo "Necessário logar!";                     
    }
    else{  

        $usu_id = $_SESSION['usu_id'];
        $com_cod = $_GET['com_cod'];
        $fil_id = $_GET['fil_id'];

        $q_descurtido = "Select * From ReacaoComentario Where Rc_Usuario = $usu_id and Rc_Comentario = $com_cod;";
        $res_descurtido = mysqli_query($dbc, $q_descurtido);
        

        if(mysqli_num_rows($res_descurtido) > 0){

            $reacao = mysqli_fetch_assoc($res_descurtido);
            $q_reacao = "";

            if($reacao['Rc_Dislike'] == 'True'){
                $q_reacao = "Update ReacaoComentario set Rc_Dislike = 'False' Where Rc_Usuario = $usu_id and Rc_Comentario = $com_cod;";
            }else{
                $q_reacao = "Update ReacaoComentario set Rc_like = 'False', Rc_Dislike = 'True' Where Rc_Usuario = $usu_id and Rc_Comentario = $com_cod;";
            }

            if ($q_reacao != ""){

                if(mysqli_query($dbc, $q_reacao)){                    
                    header("Location: ../filme.php?id=$fil_id");                  
                }else{
                    echo "Deu ruim ao Descurtir (Já cadastrado)";                    
                }

            }

            
            mysqli_free_result($res_descurtido);

        }else{

            $ins_reacao = "Insert Into ReacaoComentario (Rc_Usuario, Rc_Comentario, Rc_like, Rc_Dislike) 
            Values ($usu_id, $com_cod, 'False', 'True');";
                        
            if(mysqli_query($dbc, $ins_reacao)){
                header("Location: ../filme.php?id=$fil_id");                  
            }else{
                echo "Deu ruim ao Descurtir (Ainda não Cadastrado)"; 
            }

        }

    }
?>