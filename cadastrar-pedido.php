<?php include('header.php'); 

$fornecedores = selecionarTodos($conexao, 'fornecedor');
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
                        <h4 class="text-themecolor">Cadastrar Pedido</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                                <li class="breadcrumb-item active">Cadastrar Pedido</li>
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
                                <h4 class="m-b-0 text-white">Cadastre um pedido</h4>
                            </div>
                            <div class="card-body">
                                <form action="cadastrar-produto-pedido.php" method="POST">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Fornecedor</label>
                                                    <select name="cliente" class="form-control" required>
                                                        <option value="Fornecedor não cadastrado">Fornecedor Não Cadastrado</option>
                                                        <?php foreach ($fornecedores as $key) {?>
                                                            <option value=" <?php echo $key['id']; ?> "><?php echo $key['nome']; ?></option>
                                                        <?php }  ?>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>desconto (%)</label>
                                                    <small>Coloque o valor em % se desejar aplicar um desconto a este pedido</small>
                                                    <input type="number" name="desconto-porcentagem" class="form-control" min="0" max="100">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>desconto (R$)</label>
                                                    <small>Coloque o valor em R$ se desejar aplicar um desconto a este pedido</small>
                                                    <input type="number" name="desconto-real" class="form-control" onchange="setTwoNumberDecimal" min="0" step="0.01" value="0.00">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Meio de pagamento</label>
                                                    <select name="pagamento" class="form-control">
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
                                                       <option value="pago">Pago</option>
                                                       <option value="pendente">Pendente</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Data</label>
                                                    <input type="date" name="data" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Cadastrar Produtos ao pedido</button>
                                        <a href="index.php" class="btn btn-inverse">Cancelar</a>
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