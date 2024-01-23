<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Cadastrar</title>
</head>

<body>
    <a href="index.php">Cadastrar</a><br>
    <a href="listar.php">Listar</a><br>
    <h1>Cadastrar Usuários</h1>
    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <form method="post" action="processa.php">

        <labe>RA:</labe>
        <input type="text" name="ra" placeholder="Digite o número do RA"><br><br>

        <labe>Nome:</labe>
        <input type="text" name="nome" placeholder="Digite o nome completo"><br><br>

        <labe>Idade:</labe>
        <input type="text" name="idade" placeholder="Digite sua idade"><br><br>

        <labe>Sexo:</labe>
        <input type="radio" name="sexo" value="M" checked> M
        <input type="radio" name="sexo" value="F"> F<br><br>

        <labe>Endereço:</labe>
        <input type="text" name="endereco" placeholder="Digite seu endereço"><br><br>

        <labe>Nº:</labe>
        <input type="text" name="numero" placeholder="Informe o número da casa"><br><br>

        <labe>Complemento:</labe>
        <input type="text" name="complemento" placeholder="Informe o complemento"><br><br>

        <input type="submit" value="Cadastrar">
    </form>

    <script src="jquery-3.7.1.min.js"></script>
    <script src="jquery.mask.js"></script>

</body>

</html>
