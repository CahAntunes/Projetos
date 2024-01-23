<?php
session_start();

include_once("conexao.php");

$id = filter_input(INPUT_POST, 'id');
$ra = filter_input(INPUT_POST, 'ra');
$nome = filter_input(INPUT_POST, 'nome');
$idade = filter_input(INPUT_POST, 'idade');
$sexo = filter_input(INPUT_POST, 'sexo');
$endereco = filter_input(INPUT_POST, 'endereco');
$numero = filter_input(INPUT_POST, 'numero');
$complemento = filter_input(INPUT_POST, 'complemento');

$result = "UPDATE pessoa SET ra_pessoa='$ra', nome='$nome', idade='$idade', sexo='$sexo', endereco='$endereco', numero='$numero', complemento='$complemento' WHERE id='$id'";

$resultado = mysqli_query($conexao, $result);

if (mysqli_affected_rows($conexao)) {
    $_SESSION['msg'] = "<p style='color:green;'>Usuário editado com sucesso!</p>";
    header("Location: listar.php");
} else {
    $_SESSION['msg'] = "<p style='color:red;'>Não foi possivel editar cadastro.</p>";
    header("Location: editar.php?id=$id");
}
