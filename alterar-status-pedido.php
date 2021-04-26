<?php 	

include('header.php');

$status = $_POST["status"];
$meio_pagamento = $_POST["pagamento"];
$id = $_POST["id"];

alterar($id, 'pedido', 'status', $status, $conexao);
alterar($id, 'pedido', 'meio_pagamento', $meio_pagamento, $conexao);

echo '<script>alert("Sucesso");window.history.back();</script>';