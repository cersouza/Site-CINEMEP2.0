<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-2 rounded sticky-top">            
    <ul class="navbar-nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link <?= ($tabela == 'usuario')? 'active':''; ?>" href="dashboard.php?tb=usuario&op=menu">Usuário</a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= ($tabela == 'moderador')? 'active':''; ?>" href="dashboard.php?tb=moderador&op=menu">Moderador</a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= ($tabela == 'filme')?'active':''; ?>" href="dashboard.php?tb=filme&op=menu">Filme</a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= ($tabela == 'ator'   )?'active':''; ?>" href="dashboard.php?tb=ator&op=menu">Ator</a>
        </li>   

        <li class="nav-item">
            <a class="nav-link <?= ($tabela == 'genero')?'active':''; ?>" href="dashboard.php?tb=genero&op=menu">Gênero</a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= ($tabela == 'classificacao')?'active':''; ?>" href="dashboard.php?tb=classificacao&op=menu">Classificação</a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= ($tabela == 'distribuidora')?'active':''; ?>" href="dashboard.php?tb=distribuidora&op=menu">Distribuidora</a>
        </li>
    </ul>
</nav>