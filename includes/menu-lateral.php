<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-2 rounded">
    <div class="container flex-column p-0">
    <!-- Gerenciar Usuários -->
        <!--button class="btn btn-primary w-100 my-1" type="button" data-toggle="collapse" data-target="#opcoes_usuario" aria-expanded="false" aria-controls="opcoes_usuario">
            Usuário
        </button>
        <div class="collapse <?= ($tabela == 'usuario')?'show':''; ?>" id="opcoes_usuario">
            <ul class="navbar-nav flex-column"> 
                <li class="nav-item">
                    <a class="nav-link <?= ($operacao == 'inc')?'active':''; ?>" href="dashboard.php?tb=usuario&op=inc">Cadastrar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($operacao == 'alt')?'active':''; ?>" href="dashboard.php?tb=usuario&op=alt">Alterar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($operacao == 'exc')?'active':''; ?>" href="dashboard.php?tb=usuario&op=exc">Excluir</a>
                </li>                    
            </ul>
        </div --> 
        <a class="btn btn-primary nav-link" href="dashboard.php?tb=usuario&op=menu">Usuário</a>

        <!-- Gerenciar Moderadores -->
        <button class="btn btn-primary w-100 my-1" type="button" data-toggle="collapse" data-target="#opcoes_moderador" aria-expanded="false" aria-controls="opcoes_moderador">
            Moderador
        </button>
        <div class="collapse <?= ($tabela == 'moderador')?'show':''; ?>" id="opcoes_moderador">
            <ul class="navbar-nav flex-column"> 
                <li class="nav-item">
                    <a class="nav-link <?= ($operacao == 'inc')?'active':''; ?>" href="dashboard.php?tb=moderador&op=inc">Cadastrar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($operacao == 'alt')?'active':''; ?>" href="dashboard.php?tb=moderador&op=alt">Alterar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($operacao == 'exc')?'active':''; ?>" href="dashboard.php?tb=moderador&op=exc">Excluir</a>
                </li>                    
            </ul>
        </div>    

    <!-- Gerenciar Filmes -->
        <button class="btn btn-primary w-100 my-1" type="button" data-toggle="collapse" data-target="#opcoes_filmes" aria-expanded="false" aria-controls="opcoes_filmes">
            Filme
        </button>
        <div class="collapse <?= ($tabela == 'filme')?'show':''; ?>" id="opcoes_filmes">
            <ul class="navbar-nav flex-column"> 
                <li class="nav-item">
                    <a class="nav-link <?= ($operacao == 'inc')?'active':''; ?>" href="dashboard.php?tb=filme&op=inc">Cadastrar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($operacao == 'alt')?'active':''; ?>" href="dashboard.php?tb=filme&op=alt">Alterar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($operacao == 'exc')?'active':''; ?>" href="dashboard.php?tb=filme&op=exc">Excluir</a>
                </li>                  
            </ul>
        </div>  

    <!-- Gerenciar Atores -->
    <button class="btn btn-primary w-100 my-1" type="button" data-toggle="collapse" data-target="#opcoes_ator" aria-expanded="false" aria-controls="opcoes_ators">
            Ator
        </button>
        <div class="collapse <?= ($tabela == 'ator')?'show':''; ?>" id="opcoes_ator">
            <ul class="navbar-nav flex-column"> 
            <li class="nav-item">
                <a class="nav-link <?= ($operacao == 'inc')?'active':''; ?>" href="dashboard.php?tb=ator&op=inc">Cadastrar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($operacao == 'alt')?'active':''; ?>" href="dashboard.php?tb=ator&op=alt">Alterar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($operacao == 'exc')?'active':''; ?>" href="dashboard.php?tb=ator&op=exc">Excluir</a>
            </li>                    
            </ul>
        </div> 

    <!-- Gerenciar Gênero -->
    <button class="btn btn-primary w-100 my-1" type="button" data-toggle="collapse" data-target="#opcoes_genero" aria-expanded="false" aria-controls="opcoes_genero">
        Gênero
    </button>
    <div class="collapse <?= ($tabela == 'genero')?'show':''; ?>" id="opcoes_genero">
        <ul class="navbar-nav flex-column"> 
            <li class="nav-item">
                <a class="nav-link <?= ($operacao == 'inc')?'active':''; ?>" href="dashboard.php?tb=genero&op=inc">Cadastrar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($operacao == 'alt')?'active':''; ?>" href="dashboard.php?tb=genero&op=alt">Alterar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($operacao == 'exc')?'active':''; ?>" href="dashboard.php?tb=genero&op=exc">Excluir</a>
            </li>                  
        </ul>
    </div>

    <!-- Gerenciar Classificação -->
    <button class="btn btn-primary w-100 my-1" type="button" data-toggle="collapse" data-target="#opcoes_class" aria-expanded="false" aria-controls="opcoes_class">
        Classificação
    </button>
    <div class="collapse <?= ($tabela == 'classificacao')?'show':''; ?>" id="opcoes_class">
        <ul class="navbar-nav flex-column"> 
            <li class="nav-item">
                <a class="nav-link <?= ($operacao == 'inc')?'active':''; ?>" href="dashboard.php?tb=classificacao&op=inc">Cadastrar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($operacao == 'alt')?'active':''; ?>" href="dashboard.php?tb=classificacao&op=alt">Alterar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($operacao == 'exc')?'active':''; ?>" href="dashboard.php?tb=classificacao&op=exc">Excluir</a>
            </li>                  
        </ul>
    </div>

    <!-- Gerenciar Distribuidora -->
    <button class="btn btn-primary w-100 my-1" type="button" data-toggle="collapse" data-target="#opcoes_dist" aria-expanded="false" aria-controls="opcoes_dist">
        Distribuidora
    </button>
    <div class="collapse <?= ($tabela == 'distribuidora')?'show':''; ?>" id="opcoes_dist">
        <ul class="navbar-nav flex-column"> 
            <li class="nav-item">
                <a class="nav-link <?= ($operacao == 'inc')?'active':''; ?>" href="dashboard.php?tb=distribuidora&op=inc">Cadastrar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($operacao == 'alt')?'active':''; ?>" href="dashboard.php?tb=distribuidora&op=alt">Alterar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($operacao == 'exc')?'active':''; ?>" href="dashboard.php?tb=distribuidora&op=exc">Excluir</a>
            </li>                  
        </ul>
    </div>          
    </div>
</nav>