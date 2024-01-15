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

function proximo_codigo_produto($conexao) {

    $sql = "SELECT MAX(codigo) AS codigo FROM produtos";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $dados = mysqli_fetch_assoc($resultado);
        $codigo = $dados['codigo'] + 1;
    } else {
        $codigo = 1;
    }

    return str_pad($codigo, 3, "0", STR_PAD_LEFT);
}

?> 
