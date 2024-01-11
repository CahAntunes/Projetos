<?php

if (!empty($_POST)) {
    include_once("conexao.php");

    $sql_max_codigo = "SELECT MAX(codigo) AS max_codigo FROM produtos";
    $result_max_codigo = $conexao->query($sql_max_codigo);
    $row_max_codigo = $result_max_codigo->fetch_assoc();
    $proximo_codigo = $row_max_codigo['max_codigo'] + 1;


    $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : $proximo_codigo;
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $unidade = $_POST['unidade'];
    $venda = $_POST['venda'];
    $fazparte = $_POST['fazparte'];


    $sql_codigo = "select codigo from produtos where codigo = '$codigo'";
    $result_codigo = $conexao->query($sql_codigo);

    $sql_nome = "select nome from produtos where nome = '$nome'";
    $result_nome = $conexao->query($sql_nome);


    if ($result_codigo->num_rows > 0) {
        echo "<script>alert('Código já Cadastrado! Digite um novo código.');</script>";
    } elseif ($result_nome->num_rows > 0) {
        echo "<script>alert('Nome já Cadastrato! Digite um novo nome.');</script>";
    } else {
        $sql = "insert ignore into produtos (codigo, nome, descricao, valor, unidade, venda, fazparte) values ('$codigo', '$nome', '$descricao', '$valor', '$unidade', '$venda','$fazparte')";

        if ($conexao->query($sql) === TRUE) {
            echo "<script>alert('Dados inseridos com sucesso!')</script>";
        } else {
            echo "<script>alert('Erro ao inserir dados!')" . $conexao->error . "</script>";
        }
    }

    mysqli_close($conexao);
}

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
                <a href="index.php">
                    <li>Cadastro</li>
                </a>
                <a href="consultas.php">
                    <li>Consultas</li>
                </a>
            </ul>
        </nav>
        <section>
            <h1>Cadastro de Produtos</h1>
            <hr><br><br>

            <form method="post" action="index.php">
                <input type="submit" value="Salvar" class="btn">
                <input type="reset" value="Limpar" class="btn">
                <br><br>

                Código do Produto<br>
                <input type="text" name="codigo" class="campo" maxlength="10" placeholder="Digite o código do produto"  required autofocus><br><br>

                Nome<br>
                <input type="text" name="nome" class="campo" maxlength="100" placeholder="Digite o nome do produto" required autofocus><br><br>

                Descrição<br>
                <input type="text" name="descricao" class="campo" maxlength="100" placeholder="Digite o código do produto" required autofocus><br><br>

                Valor(un)<br>
                <input type="text" id="valor" name="valor" class="campo" placeholder="Valor em R$" required autofocus><br><br>

                Unidade<br>
                <select name="unidade" class="campo">
                    <option value="mg">mg</option>
                    <option value="g">g</option>
                    <option value="kg">kg</option>
                    <option value="cm">cm</option>
                    <option value="m">m</option>
                    <option selected value="un">un</option>
                </select><br><br>

                Valor(Venda)<br>
                <input type="text" id="venda" name="venda" class="campo" placeholder="Valor em R$" required autofocus><br><br>

                Faz Parte?</b><br>
                <input type="radio" name="fazparte" value="sim" checked /> Sim
                <input type="radio" name="fazparte" value="nao" /> Não<br />

            </form>

            <script src="jquery-3.7.1.min.js"></script>
            <script src="jquery.mask.js"></script>

            <script>
                $('#valor').mask("#.##0,00", {
                    reverse: true
                });
                $('#venda').mask("#.##0,00", {
                    reverse: true
                });
            </script>

        </section>
    </div>

</body>

</html>
