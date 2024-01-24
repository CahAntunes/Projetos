<?php
session_start();
include_once("conexao.php");
$id = filter_input(INPUT_GET, 'id');

if (!empty($id)) {
    $result_usuario = "DELETE FROM pessoa WHERE id='$id'";
    $resultado_usuario = mysqli_query($conexao, $result_usuario);
    if (mysqli_affected_rows($conexao)) {
        $_SESSION['msg'] = "<p style='color:green;'>Usuário apagado com sucesso!</p>";
        header("Location: index.php");
    } else {
        $_SESSION['msg'] = "<p style='color:red;'>Não foi possivel apagar esse cadastro.</p>";
        header("Location: index.php");
    }
}else {
    $_SESSION['msg'] = "<p style='color:red;'>Necesário selecionar um usuário.</p>";
        header("Location: index.php");
}
