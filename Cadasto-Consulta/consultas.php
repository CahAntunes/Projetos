<?php

include_once("conexao.php");

$filtro = isset($_GET['filtro'])?$_GET['filtro']:"";

$sql = "select * from produtos where nome like '%$filtro%'order by nome";


$consulta = mysqli_query($conexao, $sql);
$registro = mysqli_num_rows($consulta);

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
            <h1>Consultas de Produtos</h1>
            <hr><br>

            <form method="get" action="">
                Filtrar por Nome do Produto: <input type="text" name="filtro" class="campo" required autofocus>
                <input type="submit" value="Pesquisar" class="btn">
            </form>

            <?php

            print "Resultado da pesquisa com a palavra <strong>$filtro</strong><br><br>";

            print "$registro registros encontrados.";

            print "<br><br>";

            while ($exibirRegistro = mysqli_fetch_array($consulta)) {

                $id = $exibirRegistro[0];
                $codigo = $exibirRegistro[1];
                $nome = $exibirRegistro[2];
                $descricao = $exibirRegistro[3];
                $valor = $exibirRegistro[4];
                $unidade = $exibirRegistro[5];
                $venda = $exibirRegistro[6];
                $fazparte = $exibirRegistro[7];

                print "<article>";

                print "$id<br>";
                print "$codigo<br>";
                print "$nome<br>";
                print "$descricao<br>";
                print "$valor<br>";
                print "$unidade<br>";
                print "$venda<br>";
                print "$fazparte<br><br>";


                print "<a href='index.php?id=$id' class='btn-editar'>Editar</a>";
                print "&nbsp;";
                print "&nbsp;";
                print "&nbsp;";
                print "<a href='excluir.php?id=$id' class='btn-excluir' onclick='return confirmarExclusao(); '>Excluir</a>";
                print "&nbsp;";
                print "&nbsp;";
                print "&nbsp;";

                $idProduto = $exibirRegistro['id'];
                echo "<a href='index.php?copiar=$idProduto' class='btn-copiar'>Copiar</a>";

                print "</article>";
            }

            mysqli_close($conexao);

            ?>

        </section>
    </div>

    <script>
    function confirmarExclusao() {
        return confirm("Deseja mesmo excluir esse produto?");
    }

</script>

</body>

</html>
