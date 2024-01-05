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
            <h1>Cadastro de Produtos</h1>
            <hr><br><br>

            <form method="post" action="processa.php">
                <input type="submit" value="Salvar" class="btn">
                <input type="reset" value="Limpar" class="btn">
                <br><br>

                Código do Produto<br>
                <input type="text" name="codigo" class="campo" maxlength="10" placeholder="Digite o código do produto" required autofocus><br><br>

                Descrição<br>
                <input type="text" name="descricao" class="campo" maxlength="100" placeholder="Digite o código do produto" required autofocus><br><br>

                Valor<br>
                <input type="text" name="valor" class="campo" maxlength="8" onkeydown="maskvalor('valor');" placeholder="Valor em R$" value required><br><br>

                Unidade<br>
                <select name="unidade" class="campo">
                    <option value="mg">mg</option>
                    <option value="g">g</option>
                    <option value="Kg">Kg</option>
                    <option value="cm">cm</option>
                    <option value="m">m</option>
                </select><br><br>

                Faz Parte?</b><br>
                <input type="radio" name="fazparte" value="sim" /> Sim
                <input type="radio" name="fazparte" value="nao" /> Não<br />


            </form>
        </section>
    </div>

</body>

</html>
