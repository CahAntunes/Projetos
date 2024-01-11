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


?>
