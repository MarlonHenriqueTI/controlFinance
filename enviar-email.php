<?php 

$emails = selecionarTodosPeriodo($conexao, 'email', date('Y-m-d', "-1 day"), date('Y-m-d'));

foreach ($emails as $key) {

	if($key["enviado"] == 0){

		if($key["destinatario"] == "clientes"){
			$clientes = selecionarTodos($conexao, 'cliente');
			foreach ($clientes as $cliente) {
				$destinatario = $cliente["email"]; //Seu e-mail vai aqui
				// envia o email
				mail($destinatario, $key["assunto"] , $key["mensagem"], "From: $destinatario\r\n");
			}
		} else if($key["destinatario"] == "usuarios"){
			$usuarios = selecionarTodos($conexao, 'usuario');
			foreach ($usuarios as $usuario) {
				$destinatario = $usuario["email"]; //Seu e-mail vai aqui
				// envia o email
				mail($destinatario, $key["assunto"] , $key["mensagem"], "From: $destinatario\r\n");
			}
		} else if($key["destinatario"] == "todos") {
			$clientes = selecionarTodos($conexao, 'cliente');
			$usuarios = selecionarTodos($conexao, 'usuario');
			foreach ($clientes as $cliente) {
				$destinatario = $cliente["email"]; //Seu e-mail vai aqui
				// envia o email
				mail($destinatario, $key["assunto"] , $key["mensagem"], "From: $destinatario\r\n");
			}
			foreach ($usuarios as $usuario) {
				$destinatario = $usuario["email"]; //Seu e-mail vai aqui
				// envia o email
				mail($destinatario, $key["assunto"] , $key["mensagem"], "From: $destinatario\r\n");
			}
		} else {
			$destinatario = $key["destinatario"]; //Seu e-mail vai aqui
			// envia o email
			mail($destinatario, $key["assunto"] , $key["mensagem"], "From: $destinatario\r\n");
		}

		alterar($key["id"], 'email', 'enviado', 1, $conexao);
	}

}