<?php

include_once("conexao.php");

$codigo = $_POST['codigo'];
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$unidade = $_POST['unidade'];
$venda = $_POST['venda'];
$fazparte = $_POST['fazparte'];

$sql = "insert ignore into produtos (codigo, nome, descricao, valor, unidade, venda, fazparte) values ('$codigo', '$nome', '$descricao', '$valor', '$unidade', '$venda','$fazparte')";
$salvar = mysqli_query($conexao, $sql);

$linhas = mysqli_affected_rows($conexao);

mysqli_close($conexao);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Cadastro de Produtos</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <nav>
            <ul class="menu">
                <a href="index.php"><li>Cadastro</li></a>
                <a href="consultas.php"><li>Consultas</li></a>
            </ul>
        </nav>
        <section>
            <h1>Confirmação de Cadastro de Produtos</h1>
            <hr><br><br>

            <?php

            if ($linhas == 1) {
                print "Cadastro efetuado com sucesso!";
            }else{
                print "Cadastro NÃO efetuado!";
            }

            ?>
        </section>
    </div>
</body>
</html>
