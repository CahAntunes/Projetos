<?php 

include_once("conexao.php");

$sql = "select * from produtos";
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
                Filtrar por Código: <input type="text" name="filtro" class="campo" required autofocus>
                <input type="submit" value="Pesqisar" class="btn"> 
            </form

            <?php 
        
            print "$registro registros encontrados.";

            print "<br><br>";

            while ($exibirRegistro = mysqli_fetch_array($consulta)){

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
                print "$fazparte";

                print "</article>";
            
            }

            mysqli_close($conexao);

            ?>

        </section>
    </div>
</body>
</html>
