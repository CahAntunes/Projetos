<?php 

$servidor = "localhost";
$usuario = "root";
$senha = "12345678";
$dbname = "produtos";


$conexao = mysqli_connect($servidor, $usuario, $senha, $dbname);

if(!$conexao){
    print "Falha na conexão com o Banco de Dados";
}

?>
