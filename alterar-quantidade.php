<?php 	

include('header.php');

$qtd = $_POST["qtd"];
$id = $_POST["id"];

alterar($id, 'produto', 'quantidade', $qtd, $conexao);

echo '<script>alert("Sucesso");window.history.back();</script>';