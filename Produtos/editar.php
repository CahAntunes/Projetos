<?php
session_start();

include_once("conexao.php");

$id = filter_input(INPUT_GET, 'id');
$result_usuario = "SELECT * FROM pessoa WHERE id = '$id'";
$resultado_usuario = mysqli_query($conexao, $result_usuario);
$row_usuario = mysqli_fetch_array($resultado_usuario); 

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Editar</title>
</head>

<body>
    <a href="index.php">Cadastrar</a><br>
    <a href="listar.php">Listar</a><br>
    <h1>Editar Usuários</h1>
    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <form method="post" action="proc_edit_usuario.php">
        <input type="hidden" name="id" value="<?php echo $row_usuario['id']; ?>" />

        <label>RA: </label>
        <input type="text" name="ra" placeholder="Digite o número do RA" value="<?php echo $row_usuario['ra_pessoa']; ?>"><br><br>

        <label>Nome: </label>
        <input type="text" name="nome" placeholder="Digite o nome completo" value="<?php echo $row_usuario['nome']; ?>"><br><br>

        <label>Idade: </label>
        <input type="text" name="idade" placeholder="Digite sua idade" value="<?php echo $row_usuario['idade']; ?>"><br><br>

        <label>Sexo: </label>
        <input type="radio" name="sexo" value="M" <?php echo isset($row_usuario['sexo']) ? (($row_usuario['sexo'] == 'M') ? 'checked' : '') : 'checked'; ?>> M

        <input type="radio" name="sexo" value="F" <?php echo isset($row_usuario['sexo']) ?  (($row_usuario['sexo'] == 'F') ? 'checked' : '') : ''; ?>> F<br><br>

        <label>Endereço: </label>
        <input type="text" name="endereco" placeholder="Digite seu endereço" value="<?php echo $row_usuario['endereco']; ?>"><br><br>

        <label>Nº: </label>
        <input type="text" name="numero" placeholder="Informe o número da casa" value="<?php echo $row_usuario['numero']; ?>"><br><br>

        <label>Complemento: </label>
        <input type="text" name="complemento" placeholder="Informe o complemento" value="<?php echo $row_usuario['complemento']; ?>"><br><br>

        <input type="submit" value="Editar">
    </form>



</body>

</html>
