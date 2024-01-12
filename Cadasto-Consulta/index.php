<?php

include_once("conexao.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $consulta = mysqli_query($conexao, "SELECT * FROM produtos WHERE id = $id");

    if ($consulta) {
        $dadosProduto = mysqli_fetch_assoc($consulta);
    } else {
        echo "<script>alert('Erro ao recuperar os dados do produto!');</script>" . mysqli_error($conexao);
        exit;
    }
}

if (!empty($_POST)) {

    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $unidade = $_POST['unidade'];
    $venda = $_POST['venda'];
    $fazparte = $_POST['fazparte'];


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
            <ul class="menu"><a href="index.php">
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

            <form method="post" action="index.php" id="meuFormulario" onsubmit="return confirmarAlteracao()">

                <input type="hidden" id="idProduto" value="<?php echo isset($dadosProduto['id']) ? $dadosProduto['id'] : '' ?>">
                <input type="submit" value="Salvar" class="btn">
                <input type="reset" value="Limpar" class="btn">
                <br><br>

                Código do Produto<br>
                <input type="text" name="codigo" class="campo" maxlength="10" placeholder="Digite o código do produto" <?php isset($dadosProduto['codigo']) ? print_r('readonly') : print_r(''); ?> value="<?php echo isset($dadosProduto['codigo']) ? $dadosProduto['codigo'] : ''; ?>" required autofocus><br><br>

                Nome<br>
                <input type="text" name="nome" class="campo" maxlength="100" placeholder="Digite o nome do produto" value="<?php echo isset($dadosProduto['nome']) ? $dadosProduto['nome'] : ''; ?>" required autofocus><br><br>

                Descrição<br>
                <input type="text" name="descricao" class="campo" maxlength="100" placeholder="Digite o código do produto" value="<?php echo isset($dadosProduto['descricao']) ? $dadosProduto['descricao'] : ''; ?>" required autofocus><br><br>

                Valor(un)<br>
                <input type="text" id="valor" name="valor" class="campo" placeholder="Valor em R$" value="<?php echo isset($dadosProduto['valor']) ? $dadosProduto['valor'] : ''; ?>" required autofocus><br><br>

                Unidade<br>
                <select name="unidade" class="campoSelect">
                    <option value="mg" <?php echo isset($dadosProduto['unidade']) ? (($dadosProduto['unidade'] == 'mg') ? 'selected' : '') : ''; ?>>mg</option>
                    <option value="g" <?php echo isset($dadosProduto['unidade']) ? (($dadosProduto['unidade'] == 'g') ? 'selected' : '') : ''; ?>>g</option>
                    <option value="kg" <?php echo isset($dadosProduto['unidade']) ? (($dadosProduto['unidade'] == 'kg') ? 'selected' : '') : ''; ?>>kg</option>
                    <option value="m" <?php echo isset($dadosProduto['unidade']) ? (($dadosProduto['unidade'] == 'm') ? 'selected' : '') : ''; ?>>m</option>
                    <option value="cm" <?php echo isset($dadosProduto['unidade']) ? (($dadosProduto['unidade'] == 'cm') ? 'selected' : '') : ''; ?>>cm</option>
                    <option value="un" <?php echo isset($dadosProduto['unidade']) ? (($dadosProduto['unidade'] == 'un') ? 'selected' : '') : 'selected'; ?>>un</option>
                </select><br><br>

                Valor(Venda)<br>
                <input type="text" id="venda" name="venda" class="campo" placeholder="Valor em R$" value="<?php echo isset($dadosProduto['venda']) ? $dadosProduto['venda'] : ''; ?>" required autofocus><br><br>

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
            var id = $('#idProduto').val(); 
            if(id != '') {
                return confirm("Deseja mesmo editar esse produto?");
            }else{
                return confirm("Dseja mesmo cadastrar esse produto?");
            }          
            
        }

    </script>

</body>

</html>
