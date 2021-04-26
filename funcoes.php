<?php 

include('bancodedados/conecta-db.php');

/*funções para deletar*/
function deletar($id, $tabela, $conexao){
	$query = "DELETE FROM `$tabela` WHERE `$tabela`.`id` = $id";
	$resultado = mysqli_query($conexao,$query);
	if(!$resultado){
		echo "<script>alert('Erro ao deletar...');</script>";
		die();
	} else {
		echo "<script>alert('Deletado com sucesso...');window.location.href='javascript:history.back()';</script>";
	}
}

if(isset($_GET["id"]) && isset($_GET["tabela"]) && isset($_GET["deletar"])){
	deletar($_GET["id"], $_GET["tabela"], $conexao);
}

if(isset($_GET["id"]) && isset($_GET["tabela"]) && isset($_GET["deletarvenda"])){
	$produtos_venda = selecionarUnico($conexao, 'produtos_venda', 'id_venda', $_GET['id']);
	foreach ($produtos_venda as $key) {
		$produto = selecionarUnico($conexao, 'produto', 'id', $key['id_produto']);
		$quantidade = $produto[0]['quantidade'] + $key['quantidade'];
		alterar($produto[0]['id'], 'produto','quantidade',$quantidade, $conexao);
	}
	deletar($_GET["id"], 'venda', $conexao);
}


/*funções para Alterar*/
function alterar($id, $tabela, $campo, $valor, $conexao){
	$query = "UPDATE `$tabela` SET `$campo` = '$valor' WHERE `$tabela`.`id` = $id";
	$resultado = mysqli_query($conexao,$query);
	if(!$resultado){
		echo "<script>alert('Erro ao alterar...');</script>";
		die();
	}
}

if(isset($_GET["id"]) && isset($_GET["tabela"]) && isset($_GET["alterar"]) && isset($_GET["campo"]) && isset($_GET["valor"])){
	alterar($_GET["id"], $_GET["tabela"],$_GET["campo"],$_GET["valor"], $conexao);
}

/*Funções para seleções*/
function selecionarTodos($conexao, $tabela){
	$query = "SELECT * FROM `$tabela` order by `id` desc";
	$resultado = mysqli_query($conexao, $query);
	if(!$resultado){
		echo '<script>alert("Nenhum registro encontrado...");</script>';
	} else {
		foreach ($resultado as $key) {
			$res[] = $key;
		}
		return $res;
	}
}

function selecionarUnico($conexao, $tabela, $campo, $valor){ 
	$query = "SELECT * FROM `$tabela` where `$tabela`.`$campo` = '$valor'";
	$resultado = mysqli_query($conexao, $query);
	if(!$resultado){
		echo '<script>alert("Nenhum registro encontrado...");</script>';
	} else {
		foreach ($resultado as $key) {
			$res[] = $key;
		}
		return $res;
	}
}

function selecionarUltimosLimite($conexao, $tabela, $limite){
	$query = "SELECT * FROM `$tabela` order by `id` desc limit $limite";
	$resultado = mysqli_query($conexao, $query);
	if(!$resultado){
		echo 'Nenhum registro encontrado...';
	} else {
		foreach ($resultado as $key) {
			$res[] = $key;
		}
		return $res;
	}
}

function selecionarTodosHoje($conexao, $tabela, $data){
	$query = "SELECT * FROM `$tabela` where `data` = '$data'  order by `id` desc";
	$resultado = mysqli_query($conexao, $query);
	if(!$resultado){
		echo '<script>alert("Nenhum registro encontrado...");</script>';
	} else {
		foreach ($resultado as $key) {
			$res[] = $key;
		}
		return $res;
	}
}

function selecionarTodosPeriodo($conexao, $tabela, $inicio, $final){
	$query = "SELECT * FROM `$tabela` where `data` between '$inicio' and '$final'  order by `id` desc";
	$resultado = mysqli_query($conexao, $query);
	if(!$resultado){
		echo '<script>alert("Nenhum registro encontrado...");</script>';
	} else {
		foreach ($resultado as $key) {
			$res[] = $key;
		}
		return $res;
	}
}

function selecionarUnicoPeriodo($conexao, $tabela, $campo, $valor, $inicio, $final){
	$query = "SELECT * FROM `$tabela` where `$tabela`.`$campo` = '$valor' and `data` between '$inicio' and '$final'";
	$resultado = mysqli_query($conexao, $query);
	if(!$resultado){
		echo '<script>alert("Nenhum registro encontrado...");</script>';
	} else {
		foreach ($resultado as $key) {
			$res[] = $key;
		}
		return $res;
	}
}

function selecionarAdminEmail($conexao, $email){
	$query = "SELECT * FROM `usuario` WHERE `email` = '$email'";
	$resultado = mysqli_query($conexao, $query);
	if(!$resultado){
		echo '<script>alert("usuario não encontrado");</script>';
	} else {
		foreach ($resultado as $key) {
			$res[] = $key;
		}
		return $res[0];
	}
} 

function selecionarUltimo($conexao, $tabela){
	$query = "SELECT * FROM `$tabela` order by `id` desc limit 1";
	$resultado = mysqli_query($conexao, $query);
	if(!$resultado){
		echo '<script>alert("Nenhum registro encontrado...");</script>';
	} else {
		foreach ($resultado as $key) {
			$res[] = $key;
		}
		return $res[0];
	}
}

function selecionarUltimaNota($conexao){
	$query = "SELECT * FROM `nfe` ORDER BY `id` DESC LIMIT 1";
	$resultado = mysqli_query($conexao, $query);
	if(!$resultado){
		echo '<script>alert("Nenhum registro encontrado...");</script>';
	} else {
		foreach ($resultado as $key) {
			$res[] = $key;
		}
		return $res[0];
	}
}

/*Funções de cadastro*/
function cadastrarCliente($conexao, $nome, $email, $telefone, $documento, $nascimento, $arquivo, $endereco, $numero, $complemento, $bairro, $cep, $estado, $municipio){
	$query = "INSERT INTO `cliente`(`nome`, `email`, `telefone`, `documento`, `nascimento`, `arquivo`, `endereco`, `numero`, `complemento`, `bairro`, `cep`, `estado`, `municipio`) VALUES ('$nome', '$email', '$telefone', '$documento', '$nascimento', '$arquivo', '$endereco', '$numero', '$complemento', '$bairro', '$cep', '$estado', '$municipio')";
	$resultado = mysqli_query($conexao, $query);
	if(!$resultado) {
		echo "<script>alert('Erro ao cadastrar cliente no sistema...');</script>";
		die();
	} else {
		echo "<script>alert('Cadastrado com sucesso...');window.location.href='todos-clientes.php';</script>";
	}
}

function cadastrarProduto($conexao, $nome,$descricao, $foto, $quantidade, $preco, $sku, $fornecedor, $compra){
	$query = "INSERT INTO `produto`(`nome`, `descricao`, `foto`, `quantidade`, `preco`, `sku`, `id_fornecedor`, `compra`) VALUES ('$nome','$descricao', '$foto', '$quantidade', '$preco', '$sku', '$fornecedor', '$compra')";
	$resultado = mysqli_query($conexao, $query);
	if(!$resultado) {
		echo "<script>alert('Erro ao cadastrar produto no sistema...');</script>";
		die();
	} else {
		echo "<script>alert('Cadastrado com sucesso...');window.location.href='estoque.php';</script>";
	}
}

function cadastrarFornecedor($conexao, $nome, $email, $telefone, $endereco, $documento, $arquivo){
	$query = "INSERT INTO `fornecedor`(`nome`, `email`, `telefone`, `endereco`, `documento`, `arquivo`) VALUES ('$nome', '$email', '$telefone', '$endereco', '$documento','$arquivo')";
	$resultado = mysqli_query($conexao, $query);
	if(!$resultado) {
		echo "<script>alert('Erro ao cadastrar fornecedor no sistema...');</script>";
		die();
	} else {
		echo "<script>alert('Cadastrado com sucesso...');window.location.href='todos-fornecedores.php';</script>";
	}
}

function cadastrarEmail($conexao, $destinatario, $mensagem, $assunto, $data){
	$query = "INSERT INTO `email`(`destinatario`, `mensagem`, `assunto`, `data`) VALUES ('$destinatario', '$mensagem', '$assunto', '$data')";
	$resultado = mysqli_query($conexao, $query);
	if(!$resultado) {
		echo "<script>alert('Erro ao programar email...');</script>";
		die();
	} else {
		echo "<script>alert('E-mail programado para envio...');window.location.href='todos-emails.php';</script>";
	}
}

function cadastrarUsuario($conexao, $nome, $email, $senha){
	$senha = md5($senha);
	$query = "INSERT INTO `usuario`(`nome`, `email`, `senha`) VALUES ('$nome', '$email', '$senha')";
	$resultado = mysqli_query($conexao, $query);
	if(!$resultado) {
		echo "<script>alert('Erro ao cadastrar usuario no sistema...');</script>";
		die();
	} else {
		$usuario = selecionarUltimo($conexao, 'usuario');
		cadastrarPermissoes($conexao, $usuario["id"]);
		echo "<script>alert('Cadastrado com sucesso...');window.location.href='permissoes.php?id=".$usuario['id']."';</script>";
	}
}


function cadastrarPermissoes($conexao, $id_usuario){
	$query = "INSERT INTO `permissoes`(`id_usuario`) VALUES ('$id_usuario')";
	$resultado = mysqli_query($conexao, $query);
	if(!$resultado) {
		echo "<script>alert('Erro ao cadastrar permissões de usuarios...');</script>";
		die();
	}
}

function cadastrarVenda($conexao, $id_cliente, $valor_total, $meio_pagamento, $status, $desconto_porcentagem, $desconto_valor, $data){
	$query = "INSERT INTO `venda`(`id_cliente`, `valor_total`, `meio_pagamento`, `status`, `desconto_porcentagem`, `desconto_valor`, `data`) VALUES ('$id_cliente', '$valor_total', '$meio_pagamento', '$status', '$desconto_porcentagem', '$desconto_valor', '$data')";
	$resultado = mysqli_query($conexao, $query);
	if(!$resultado) {
		echo "<script>alert('Erro ao cadastrar venda no sistema...');</script>";
		die();
	} else {
		echo "<script>alert('Venda cadastrada, agora cadastre os produtos da venda...');</script>";
	}
}

function cadastrarPedido($conexao, $id_fornecedor, $valor_total, $meio_pagamento, $status, $desconto_porcentagem, $desconto_valor, $data){
	$query = "INSERT INTO `pedido`(`id_fornecedor`, `valor_total`, `meio_pagamento`, `status`, `desconto_porcentagem`, `desconto_valor`, `data`) VALUES ('$id_fornecedor', '$valor_total', '$meio_pagamento', '$status', '$desconto_porcentagem', '$desconto_valor', '$data')";
	$resultado = mysqli_query($conexao, $query);
	if(!$resultado) {
		echo "<script>alert('Erro ao cadastrar pedido no sistema...');</script>";
		die();
	} else {
		echo "<script>alert('Pedido cadastrado, agora cadastre os produtos do pedido...');</script>";
	}
}

function cadastrarProdutoVenda($conexao, $id_produto, $id_venda, $quantidade){
	$query = "INSERT INTO `produtos_venda`(`id_produto`, `id_venda`, `quantidade`) VALUES ('$id_produto', '$id_venda', '$quantidade')";
	$resultado = mysqli_query($conexao, $query);
	if(!$resultado) {
		echo "<script>alert('Erro ao cadastrar produto a esta venda...');</script>";
		die();
	} else {
		$query = "UPDATE `produto` SET `quantidade`= `quantidade` - $quantidade WHERE `id` = $id_produto";
		$resultado = mysqli_query($conexao,$query);
		if(!$resultado){
			echo "<script>alert('Erro ao alterar quantidade...');</script>";
			die();
		}
		echo "<script>alert('Cadastrado com sucesso, continue cadastrando seus produtos a venda ou saia para finalizar o cadastro...');window.location.href='cadastrar-produto-venda.php';</script>";
	}
}

function cadastrarNfe($conexao,$arquivo, $data, $uuid, $status, $numero, $serie, $chave, $xml, $danfe, $recibo ){
	$query = "INSERT INTO `nfe`(`arquivo`, `data`, `uuid`, `status`, `numero`, `serie`, `chave`, `xml`, `danfe`, `recibo`) VALUES ('$arquivo', '$data', '$uuid', '$status', '$numero', '$serie', '$chave', '$xml', '$danfe', '$recibo')";
	$resultado = mysqli_query($conexao, $query);
	if(!$resultado) {
		echo "<script>alert('Erro ao cadastrar nfe no sistema...');</script>";
		die();
	} else {
		echo "<script>alert('Nfe cadastrada');</script>";
	}
}

function cadastrarProdutoPedido($conexao,$id_pedido, $quantidade, $nome, $preco){
	$query = "INSERT INTO `produtos_pedido`(`id_pedido`, `quantidade`, `nome`, `preco`) VALUES ('$id_pedido', '$quantidade', '$nome', '$preco')";
	$resultado = mysqli_query($conexao, $query);
	if(!$resultado) {
		echo "<script>alert('Erro ao cadastrar produto a este pedido...');</script>";
		die();
	} else {
			echo "<script>alert('Cadastrado com sucesso, continue cadastrando seus produtos ao pedido ou saia para finalizar o cadastro...');window.location.href='cadastrar-produto-pedido.php';</script>";
	}
}