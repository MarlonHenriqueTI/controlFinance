<?php include('header.php'); 

if(isset($_POST["cliente"])){

    $id_fornecedor = $_POST["cliente"];
    $valor = 0.00;
    $desconto_porcentagem = $_POST["desconto-porcentagem"];
    $desconto_valor = $_POST["desconto-real"];
    $pagamento = $_POST["pagamento"];
    $status = $_POST["status"];
    $data = $_POST["data"];
    cadastrarPedido($conexao, $id_fornecedor, $valor, $pagamento, $status, $desconto_porcentagem, $desconto_valor, $data);
}

$pedido = selecionarUltimo($conexao, 'pedido');

if(isset($_POST["nome"])){
    $nome = $_POST["nome"];
    $preco = $_POST['preco'];
    $qtd = $_POST["qtd"];
    $id = $_POST['id'];
    cadastrarProdutoPedido($conexao,$id, $qtd, $nome, $preco);
     $total = $pedido['valor_total'];
        $total = $total + ($preco * $qtd);
        alterar($pedido['id'], 'pedido', 'valor_total', $total, $conexao);
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
                                <h4 class="m-b-0 text-white">Cadastre um produto ao pedido</h4>
                            </div>
                            <div class="card-body">
                                <form action="cadastrar-produto-pedido.php" method="POST">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Nome do produto</label>
                                                    <input type="text" name="nome" class="form-control" placeholder="Nome do produto" required>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Preço</label>
                                                    <input type="number" name="preco" class="form-control" onchange="setTwoNumberDecimal" min="0" step="0.01" value="0.00">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Quantidade</label>
                                                    <input type="number" name="qtd" class="form-control" placeholder="Selecione a quantidade" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" name="id" value="<?php echo $pedido['id']; ?>" style="display: none;">
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Cadastrar mais Produtos ao pedido</button>
                                        <a href="pedidos.php" class="btn btn-inverse">Finalizar Cadastro</a>
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