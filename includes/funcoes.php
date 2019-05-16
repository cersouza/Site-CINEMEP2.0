<?php
//Mensagens
function show_msg($tipo, $msg){
    $mensagem = "";

    if ($tipo == "success"){
        switch ($msg) {
            case 1: $mensagem = "Comentário adicionado com sucesso!";
            break;
            case 2: $mensagem = "Comentário Alterado com sucesso!";
            break;
            case 3: $mensagem = "Comentário Excluído com sucesso!";
            break;
            default: $mensagem = "Deu certo!";
            break;
        }
    }else if ($tipo == "error"){
        switch ($msg) {
            case 1: $mensagem = "Houve problema na inserção do comentário!";
            break;
            case 2: $mensagem = "Houve problema na alteração do comentário!";
            break;
            case 3: $mensagem = "Houve problema na exclusão do comentário!";
            break;
            default: $mensagem = "Ocorreu um problema!";
            break;
        }
    }

    if ($mensagem != "") echo "<script>alert('$mensagem')</script>";
}


//Funções para Modal

function mdl_erro($erro){
    echo "<div class='modal fade' id='erro' tabindex='0' role='dialog' aria-labelledby='#' aria-hidden='false'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='show_erro'>Erro</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>

                    <div class='modal-body'>
                        <p>$erro</p>
                    </div>

                    <div class='modal-footer'>
                        <button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>                        
                    </div>
                </div>
            </div>
        </div>";
}

function mdl_excComentario ($com_cod){

    echo "<div class='modal fade' id='mdl_confExc".$com_cod."' tabindex='".-1 * $com_cod."' role='dialog' aria-labelledby='exc_cmt".$com_cod."' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='exc_cmt".$com_cod."'>Excluir Comentário</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>

                    <div class='modal-body'>
                        <p>Você realmente deseja excluir esse comentário?</p>
                    </div>

                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                        <a href='BD/exc_comentario.php?com_cod=$com_cod'><button type='button' class='btn btn-danger'>Excluir</button></a>
                    </div>
                </div>
            </div>
        </div>";
}

function mdl_altComentario ($filme_id, $com_nota, $com_cod, $com_desc){
    
    $slt_nota1 = "";
    $slt_nota2 = "";
    $slt_nota3 = "";
    $slt_nota4 = "";
    $slt_nota5 = "";

    switch ($com_nota)
        {
            case 1: $slt_nota1 = "selected";
            break;
            case 2: $slt_nota2 = "selected";
            break;
            case 3: $slt_nota3 = "selected";
            break;
            case 4: $slt_nota4 = "selected";
            break;
            case 5: $slt_nota5 = "selected";
            break;
        }


    echo "<div class='modal fade' id='mdl_confAlt".$com_cod."' tabindex='".-1 * $com_cod."' role='dialog' aria-labelledby='alt_cmt".$com_cod."' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                <form class='form-group' method='POST' action='BD/alt_comentario.php'>

                    <div class='modal-header'>
                        <h5 class='modal-title' id='alt_cmt".$com_cod."'>Editar Comentário</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>

                    <div class='modal-body'>
                        
                    
                        <label for='nota'>Avaliação:</label>
                        <select name='nota_fil' class='form-control w-50' id='nota'>
                            <option value='1' $slt_nota1>1 - Péssimo</option>
                            <option value='2' $slt_nota2>2 - Ruim</option>
                            <option value='3' $slt_nota3>3 - Mais ou Menos</option>
                            <option value='4' $slt_nota4>4 - Bom</option>
                            <option value='5' $slt_nota5>5 - Excelente</option>
                        </select>

                        <label for='comment'>Comentário:</label>
                        <textarea class='form-control' rows='5' id='comment'  name='comentario' placeholder='Digite seu comentário aqui...'>$com_desc</textarea><br>

                        <input type='hidden' name='fil_id' value='$filme_id'>	                      
                        <input type='hidden' name='com_cod' value='$com_cod'>
                        

                    </div>
                    <div class='modal-footer'>                                                                    
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                        <input class='btn btn-primary' type='submit' value='Salvar'>
                    </div>
                </form>

                    
                </div>
            </div>
        </div>";
}