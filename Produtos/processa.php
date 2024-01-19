<?php 

include_once("conexao.php"); 


$nome= filter_input(INPUT_POST, 'nome', FILTER_UNSAFE_RAW);
$idade= filter_input(INPUT_POST, 'idade', FILTER_UNSAFE_RAW);
$sexo= filter_input(INPUT_POST, 'sexo', FILTER_UNSAFE_RAW);
$endereco= filter_input(INPUT_POST, 'endereco', FILTER_UNSAFE_RAW);
$numero= filter_input(INPUT_POST, 'numero', FILTER_UNSAFE_RAW);
$complemento= filter_input(INPUT_POST, 'complemento', FILTER_UNSAFE_RAW);

$result = "INSERT INTO pessoa (nome, idade, sexo, endereco, numero, complemento, created) VALUES ('$nome','$idade','$sexo', '$endereco', '$numero','$complemento', NOW())";

$resultado = mysqli_query($conexao, $result); 

?>
