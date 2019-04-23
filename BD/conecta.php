<?php
    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "VS012019WEB");

    $dbc = @mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or
    die("Erro de conexão com o banco de dados.");
?>