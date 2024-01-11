<?php
include_once("conexao.php");

if (isset($_GET['id'])) {
    $idProduto = $_GET['id'];

    $sql = "DELETE FROM produtos WHERE id = $idProduto";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado) {
        echo "<script>alert('Produto excluído com sucesso!');";
        echo "window.location.href = 'consultas.php';</script>";
    } else {
        echo "<script>alert('Erro ao excluir o produto');</script>";
    }
   

    mysqli_close($conexao);

}
?>
