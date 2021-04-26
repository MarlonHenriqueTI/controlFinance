<?php include('header.php'); 

$clientes = selecionarTodos($conexao, 'cliente');
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
                        <h4 class="text-themecolor">Cadastrar Venda</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                                <li class="breadcrumb-item active">Cadastrar Venda</li>
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
                                <h4 class="m-b-0 text-white">Cadastre uma venda</h4>
                            </div>
                            <div class="card-body">
                                <form action="cadastrar-produto-venda.php" method="POST">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Cliente</label>
                                                    <select name="cliente" class="form-control" required>
                                                        <option value="Cliente não cadastrado">Cliente Não Cadastrado</option>
                                                        <?php foreach ($clientes as $key) {?>
                                                            <option value=" <?php echo $key['id']; ?> "><?php echo $key['nome']; ?></option>
                                                        <?php }  ?>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>desconto (%)</label>
                                                    <small>Coloque o valor em % se desejar aplicar um desconto a esta venda</small>
                                                    <input type="number" name="desconto-porcentagem" class="form-control" min="0" max="100">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>desconto (R$)</label>
                                                    <small>Coloque o valor em R$ se desejar aplicar um desconto a esta venda</small>
                                                    <input type="number" name="desconto-real" class="form-control" onchange="setTwoNumberDecimal" min="0" step="0.01" value="0.00">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Meio de pagamento</label>
                                                    <select name="pagamento" class="form-control">
                                                        <option value="Ainda não foi pago">Ainda não foi pago</option>
                                                        <option value="credito">Credito</option>
                                                        <option value="debito">Debito</option>
                                                        <option value="dinheiro">Dinheiro</option>
                                                        <option value="cheque">Cheque</option>
                                                        <option value="crediario">Crediário</option>
                                                        <option value="outro">Outro</option>
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
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Cadastrar Produtos à venda</button>
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