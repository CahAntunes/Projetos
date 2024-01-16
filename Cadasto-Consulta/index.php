<?php

include_once("conexao.php");


if (isset($_GET['id']) || isset($_GET['copiar']) ) {
    $id = isset($_GET['id']) ? $_GET['id'] :  $_GET['copiar'];

    $consulta = mysqli_query($conexao, "SELECT * FROM produtos WHERE id = $id");

    if ($consulta) {
        $dadosProduto = mysqli_fetch_assoc($consulta);
    } else {
        echo "<script>alert('Erro ao recuperar os dados do produto!');</script>" . mysqli_error($conexao);
        exit;
    }
}

if (isset($_GET['copiar'])) {
    $proximo_codigo = proximo_codigo_produto($conexao);
}

if (!empty($_POST)) {

    $codigo = $_POST['codigo'];
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

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        if (!verificarNomeUnico($conexao, $nome, $id)) {

            echo "<script>alert('Nome do produto já cadastrado. Digite um novo nome.');</script>";
            echo "<script>window.location.href = 'index.php?id=$id';</script>";
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
    } else {

        // if ($codigo == '') {
        //     $codigo = $proximo_codigo;
        // }

        $sql_codigo = "SELECT codigo FROM produtos WHERE codigo = '$codigo'";
        $result_codigo = $conexao->query($sql_codigo);

        $sql_nome = "SELECT nome FROM produtos WHERE nome = '$nome'";
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
    }
}

$proximo_codigo = proximo_codigo_produto($conexao);

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
                <a href="index.php">
                    <li>Cadastro</li>
                </a>
                <a href="consultas.php">
                    <li>Consultas</li>
                </a>
            </ul>
        </nav>
        <section>
            <h1><?php isset($_GET['id']) ? print_r('Editar Produto') : print_r('Cadastro de Produtos') ?></h1>
            <hr><br><br>

            <form method="post" action="index.php">
                <?php

                if (isset($id)) {
                    echo '<input type="hidden" name="id" value="' . $id . '">';
                }
                ?>

                <input type="submit" value="Salvar" class="btn" onclick="confirmarAlteracao()">
                <input type="reset" value="Limpar" class="btn">
                <br><br>

                Código do Produto<br>
                <input type="text" name="codigo" class="campo" maxlength="10" <?php isset($dadosProduto['codigo']) ? print_r('readonly') : print_r(''); ?> value="<?php echo isset($_GET['copiar']) ? $proximo_codigo : 
                (isset($dadosProduto['codigo']) ? $dadosProduto['codigo'] : $proximo_codigo); ?>" required autofocus><br><br>

                Nome<br>
                <input type="text" name="nome" class="campo" maxlength="100" value="<?php echo isset($dadosProduto['nome']) ? $dadosProduto['nome'] : ''; ?>" required><br><br>

                Descrição<br>
                <input type="text" name="descricao" class="campo" value="<?php echo isset($dadosProduto['descricao']) ? $dadosProduto['descricao'] : ''; ?>" required><br><br>

                Valor(un)<br>
                <input type="text" id="valor" name="valor" class="campo" value="<?php echo isset($dadosProduto['valor']) ? $dadosProduto['valor'] : ''; ?>" required><br><br>

                Unidade<br>
                <select name="unidade" class="campoSelect">
                    <option value="mg" <?php echo isset($dadosProduto['unidade']) ? (($dadosProduto['unidade'] == 'mg') ? 'selected' : '') : ''; ?>>mg</option>
                    <option value="g" <?php echo isset($dadosProduto['unidade']) ? (($dadosProduto['unidade'] == 'g') ? 'selected' : '') : ''; ?>>g</option>
                    <option value="Kg" <?php echo isset($dadosProduto['unidade']) ? (($dadosProduto['unidade'] == 'Kg') ? 'selected' : '') : ''; ?>>Kg</option>
                    <option value="cm" <?php echo isset($dadosProduto['unidade']) ? (($dadosProduto['unidade'] == 'cm') ? 'selected' : '') : ''; ?>>cm</option>
                    <option value="m" <?php echo isset($dadosProduto['unidade']) ? (($dadosProduto['unidade'] == 'm') ? 'selected' : '') : ''; ?>>m</option>
                    <option value="un" <?php echo isset($dadosProduto['unidade']) ? (($dadosProduto['unidade'] == 'un') ? 'selected' : '') : 'selected'; ?>>un</option>
                </select><br><br>

                Valor(Venda)<br>
                <input type="text" id="venda" name="venda" class="campo" value="<?php echo isset($dadosProduto['venda']) ? $dadosProduto['venda'] : ''; ?>" required><br><br>

                Faz Parte?</b><br>

                <input type="radio" name="fazparte" value="Sim" <?php echo isset($dadosProduto['fazparte']) ?  (($dadosProduto['fazparte'] == 'Sim') ? 'checked' : '') : 'checked'; ?>> Sim
                <input type="radio" name="fazparte" value="Não" <?php echo isset($dadosProduto['fazparte']) ?  (($dadosProduto['fazparte'] == 'Não') ? 'checked' : '') : ''; ?>> Não<br><br>

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
