<?php

$hostname = "localhost";
$user = "root";
$password = "12345678";
$database = "cadastro";


$conexao = mysqli_connect($hostname, $user, $password, $database);


if(!$conexao){
    print "Falha na conexão com o Banco de Dados";
}


function verificarNomeUnico($conexao, $nome, $id) {
    $nome = mysqli_real_escape_string($conexao, $nome);
    $query = "SELECT * FROM produtos WHERE nome = '$nome' AND id != $id";
    $resultado = mysqli_query($conexao, $query);
    return mysqli_num_rows($resultado) == 0;
}

function proximoCodigo($conexao) {

    $query = "SELECT codigo FROM produtos ORDER BY codigo DESC LIMIT 1";
    $resultado = mysqli_query($conexao, $query);

    if ($resultado && $resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $next_code = $row['codigo'] + 1;
    } else {
        $next_code = 1;
    }

    return  'A';
}
