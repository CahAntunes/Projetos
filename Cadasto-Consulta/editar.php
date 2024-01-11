<?php

include_once("conexao.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
        $codigo = $_POST['codigo'];;
        $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
        $valor = $_POST['valor'];
        $unidade = $_POST['unidade'];
        $venda = $_POST['venda'];
        $fazparte = isset($_POST['fazparte']) ? $_POST['fazparte'] : '';

        if (!verificarNomeUnico($conexao, $nome, $id)) {
            echo "<script>alert('Nome do produto já cadastrado. Digite um novo nome.');</script>";
            echo "<script>window.location.href = 'editar.php?id=$id';</script>";
            exit;
        }

        $sql = "UPDATE produtos SET
                codigo = '$codigo',
                nome = '$nome',
                descricao = '$descricao',
                valor = '$valor',
                unidade = '$unidade',
                venda = '$venda',
                fazparte = '$fazparte'
                WHERE id = $id";


        $resultado = mysqli_query($conexao, $sql);

        if ($resultado) {
            echo "<script>alert('Produto atualizado com sucesso!');</script>";
        } else {
            echo "<script>alert('Código do produto já cadastrado. Digite um novo código.');</script>";
        }
    }

    $consulta = mysqli_query($conexao, "SELECT * FROM produtos WHERE id = $id");

    if ($consulta) {
        $dadosProduto = mysqli_fetch_assoc($consulta);
    } else {
        echo "<script>alert('Erro ao recuperar os dados do produto!');</script>" . mysqli_error($conexao);
        exit;
    }

    mysqli_close($conexao);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
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

            <h1>Editar Produto</h1>
            <hr><br>

            <form method="post" action="">

                Código do Produto<br>
                <input type="text" name="codigo" class="campo" maxlength="10" value="<?php echo $dadosProduto['codigo']; ?>" required><br><br>

                Nome<br>
                <input type="text" name="nome" class="campo" maxlength="100" value="<?php echo $dadosProduto['nome']; ?>" required><br><br>

                Descrição<br>
                <input type="text" name="descricao" class="campo" value="<?php echo $dadosProduto['descricao']; ?>" required><br><br>

                Valor(un)<br>
                <input type="text" id="valor" name="valor" class="campo" value="<?php echo $dadosProduto['valor']; ?>" required><br><br>

                Unidade<br>
                <select name="unidade" class="campo">
                    <option value="mg" <?php echo ($dadosProduto['unidade'] == 'mg') ? 'selected' : ''; ?>>mg</option>

                    <option value="g" <?php echo ($dadosProduto['unidade'] == 'g') ? 'selected' : ''; ?>>g</option>

                    <option value="kg" <?php echo ($dadosProduto['unidade'] == 'kg') ? 'selected' : ''; ?>>kg</option>

                    <option value="m" <?php echo ($dadosProduto['unidade'] == 'm') ? 'selected' : ''; ?>>m</option>

                    <option value="un" <?php echo ($dadosProduto['unidade'] == 'un') ? 'selected' : ''; ?>>un</option>
                </select><br><br>

                Valor(Venda)<br>
                <input type="text" id="venda" name="venda" class="campo" value="<?php echo $dadosProduto['venda']; ?>" required><br><br>

                Faz Parte?</b><br>

                <input type="radio" name="fazparte" value="Sim" <?php echo ($dadosProduto['fazparte'] == 'Sim') ? 'checked' : ''; ?>> Sim

                <input type="radio" name="fazparte" value="Não" <?php echo ($dadosProduto['fazparte'] == 'Não') ? 'checked' : ''; ?>> Não<br><br>


                <input type="submit" value="Salvar Alterações" onclick="confirmarAlteracao()" class="btn">


                <a id="voltar" href="consultas.php">Voltar para Consultas</a>

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

    <script>

    function confirmarAlteracao() {
        return confirm("Deseja mesmo alterar esse produto?");
    }

    </script>

</body>

</html>
