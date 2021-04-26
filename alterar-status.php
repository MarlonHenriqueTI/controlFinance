<?php 	

include('header.php');

$status = $_POST["status"];
$meio_pagamento = $_POST["pagamento"];
$id = $_POST["id"];

alterar($id, 'venda', 'status', $status, $conexao);
alterar($id, 'venda', 'meio_pagamento', $meio_pagamento, $conexao);

echo '<script>alert("Sucesso");window.history.back();</script>';