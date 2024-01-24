<?php
session_start();

include_once("conexao.php");

$ra = filter_input(INPUT_POST, 'ra');
$nome = filter_input(INPUT_POST, 'nome');
$idade = filter_input(INPUT_POST, 'idade');
$sexo = filter_input(INPUT_POST, 'sexo');
$endereco = filter_input(INPUT_POST, 'endereco');
$numero = filter_input(INPUT_POST, 'numero');
$complemento = filter_input(INPUT_POST, 'complemento');

$result = "INSERT INTO pessoa (ra_pessoa, nome, idade, sexo, endereco, numero, complemento) VALUES ('$ra','$nome','$idade','$sexo', '$endereco', '$numero','$complemento')";
$resultado = mysqli_query($conexao, $result);

if (mysqli_insert_id($conexao)) {
    $_SESSION['msg'] = "<p style='color:green;'>Usuário cadastrado com sucesso!</p>";
    header("Location: index.php");
} else {
    $_SESSION['msg'] = "<p style='color:red;'>Usuário não foi cadastrado.</p>";
    header("Location: cad_usuario.php");
}
