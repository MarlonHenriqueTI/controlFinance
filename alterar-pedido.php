<?php include('header.php'); 

$clientes = selecionarTodos($conexao, 'fornecedor');

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $venda = selecionarUnico($conexao, 'pedido', 'id', $id);
}

if(isset($_POST["cliente"])){
    alterar($id, 'pedido', 'id_fornecedor', $_POST["cliente"], $conexao);


if(isset($_POST["valor"])){
    alterar($id, 'pedido', 'valor_total', $_POST["valor"], $conexao);
}

if(isset($_POST["desconto-porcentagem"])){
    alterar($id, 'pedido', 'desconto_porcentagem', $_POST["desconto-porcentagem"], $conexao);
}

if(isset($_POST["desconto-real"])){
    alterar($id, 'pedido', 'desconto_valor', $_POST["desconto-real"], $conexao);
}

if(isset($_POST["pagamento"])){
    alterar($id, 'pedido', 'meio_pagamento', $_POST["pagamento"], $conexao);
}

if(isset($_POST["status"])){
    alterar($id, 'pedido', 'status', $_POST["status"], $conexao);
}

if(isset($_POST["data"])){
    alterar($id, 'pedido', 'data', $_POST["data"], $conexao);
}

echo '<script>alert("Sucesso");window.location.href="todas-vendas.php";</script>';
}

?>

        <div class="page-wrapper" style="min-height: 638px;">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Alterar Pedido</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                                <li class="breadcrumb-item active">Alterar Pedido</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-dark">
                                <h4 class="m-b-0 text-white">Alterar pedido</h4>
                            </div>
                            <div class="card-body">
                                <form action="alterar-pedido.php?id=<?php echo $id; ?>" method="POST">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Fornecedor</label>
                                                    <select name="cliente" class="form-control" required>
                                                         <?php $cliente = selecionarUnico($conexao, 'cliente', 'id', $venda[0]['id_cliente']); ?>
                                                        <option value=" <?php echo $cliente[0]['id']; ?> "><?php echo $cliente[0]['nome']; ?></option>
                                                        <option value="Fornecedor não cadastrado">Fornecedor Não Cadastrado</option>
                                                        <?php foreach ($clientes as $key) {?>
                                                            <option value=" <?php echo $key['id']; ?> "><?php echo $key['nome']; ?></option>
                                                        <?php }  ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Valor total do pedido</label>
                                                    <input type="number" name="valor" class="form-control" onchange="setTwoNumberDecimal" min="0" step="0.01" value="<?php echo $venda[0]['valor_total']; ?>" >
                                                </div>
                                            </div>
                                            
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>desconto (%)</label>
                                                    <small>Coloque o valor em % se desejar aplicar um desconto a esta venda</small>
                                                    <input type="number" name="desconto-porcentagem" class="form-control" min="0" max="100" value="<?php echo $venda[0]['desconto_porcentagem']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>desconto (R$)</label>
                                                    <small>Coloque o valor em R$ se desejar aplicar um desconto a esta venda</small>
                                                    <input type="number" name="desconto-real" class="form-control" onchange="setTwoNumberDecimal" min="0" step="0.01" value="<?php echo $venda[0]['desconto_valor']; ?>">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Meio de pagamento</label>
                                                    <select name="pagamento" class="form-control">
                                                        <option value="<?php echo $venda[0]["meio_pagamento"] ?>"><?php echo $venda[0]["meio_pagamento"] ?></option>
                                                        <option value="Ainda não foi pago">Ainda não foi pago</option>
                                                        <option value="À vista">À vista</option>
                                                        <option value="Cartão">Cartão</option>
                                                        <option value="Cheque">Cheque</option>
                                                        <option value="Boleto">Boleto</option>
                                                        <option value="Outro">Outro</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="<?php echo $venda[0]["status"] ?>"><?php echo $venda[0]["status"] ?></option>
                                                       <option value="pago">Pago</option>
                                                       <option value="pendente">Pendente</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Data</label>
                                                    <input type="date" name="data" class="form-control" value="<?php echo $venda[0]['data']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Alterar</button>
                                        <a href="todas-vendas.php" class="btn btn-inverse">Cancelar</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>

<?php include('footer.php'); ?>