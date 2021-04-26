<?php 
include('header.php');

$id_usuario = $_POST["id_usuario"];

$id = selecionarUnico($conexao, 'permissoes', 'id_usuario', $id_usuario);

$sistema_vendas = $_POST["sistema_vendas"];
$clientes = $_POST["clientes"];
$estoque = $_POST["estoque"];
$fornecedores = $_POST["fornecedores"];
$email = $_POST["email"];
$vendas = $_POST["vendas"];
$relatorios = $_POST["relatorios"];
$notas_fiscais = $_POST["notas_fiscais"];
$usuarios = $_POST["usuarios"];

if($sistema_vendas){
	alterar($id[0]['id'], 'permissoes', 'sistema_vendas', 1, $conexao);
} else {
	alterar($id[0]['id'], 'permissoes', 'sistema_vendas', 0, $conexao);
}

if($clientes){
	alterar($id[0]['id'], 'permissoes', 'clientes', 1, $conexao);
} else {
	alterar($id[0]['id'], 'permissoes', 'clientes', 0, $conexao);
}

if($estoque){
	alterar($id[0]['id'], 'permissoes', 'estoque', 1, $conexao);
} else {
	alterar($id[0]['id'], 'permissoes', 'estoque', 0, $conexao);
}

if($fornecedores){
	alterar($id[0]['id'], 'permissoes', 'fornecedores', 1, $conexao);
} else {
	alterar($id[0]['id'], 'permissoes', 'fornecedores', 0, $conexao);
}

if($email){
	alterar($id[0]['id'], 'permissoes', 'email', 1, $conexao);
} else {
	alterar($id[0]['id'], 'permissoes', 'email', 0, $conexao);
}

if($vendas){
	alterar($id[0]['id'], 'permissoes', 'vendas', 1, $conexao);
} else {
	alterar($id[0]['id'], 'permissoes', 'vendas', 0, $conexao);
}

if($relatorios){
	alterar($id[0]['id'], 'permissoes', 'relatorios', 1, $conexao);
} else {
	alterar($id[0]['id'], 'permissoes', 'relatorios', 0, $conexao);
}

if($notas_fiscais){
	alterar($id[0]['id'], 'permissoes', 'notas_fiscais', 1, $conexao);
} else {
	alterar($id[0]['id'], 'permissoes', 'notas_fiscais', 0, $conexao);
}

if($usuarios){
	alterar($id[0]['id'], 'permissoes', 'usuarios', 1, $conexao);
} else {
	alterar($id[0]['id'], 'permissoes', 'usuarios', 0, $conexao);
}

echo "<script>alert('Sucesso...');window.location.href='todos-usuarios.php';</script>";