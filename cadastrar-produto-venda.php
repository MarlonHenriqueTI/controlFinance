<?php include('header.php'); 

if(isset($_POST["cliente"])){

    $id_cliente = $_POST["cliente"];
    $valor = 0.00;
    $desconto_porcentagem = $_POST["desconto-porcentagem"];
    $desconto_valor = $_POST["desconto-real"];
    $pagamento = $_POST["pagamento"];
    $status = $_POST["status"];
    $data = $_POST["data"];
    cadastrarVenda($conexao, $id_cliente, $valor, $pagamento, $status, $desconto_porcentagem, $desconto_valor, $data);
}

$venda = selecionarUltimo($conexao, 'venda');
$produtos = selecionarTodos($conexao, 'produto');

if(isset($_POST["produto"])){
    $produto = $_POST["produto"];
    $qtd = $_POST["qtd"];
    $teste_qtd = selecionarUnico($conexao, 'produto', 'id', $produto);
    if($teste_qtd[0]["quantidade"] < $qtd){
        echo "<script>alert('Você não possui esta quantidade de ".$teste_qtd[0]["nome"]." em estoque, por favor tente novamente selecionando uma quantidade menor...');</script>";
    } else {
        cadastrarProdutoVenda($conexao, $produto, $venda["id"], $qtd);
        $total = $venda['valor_total'];
        $total = $total + ($teste_qtd[0]['preco'] * $qtd);
        alterar($venda['id'], 'venda', 'valor_total', $total, $conexao);
    }
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
                                <h4 class="m-b-0 text-white">Cadastre uma produto a venda</h4>
                            </div>
                            <div class="card-body">
                                <form action="cadastrar-produto-venda.php" method="POST">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="form-group">
                                                    <label>Produto</label><br>
                                                    <select name="produto" class="js-example-basic-single form-control" required style="width: 550px;">
                                                        <?php foreach ($produtos as $key) { ?>
                                                            <option value=" <?php echo $key['id']; ?> "><?php echo $key["nome"]." - Disponivel (".$key["quantidade"].") - Preço: R$".$key['preco']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Quantidade Vendida</label>
                                                    <input type="number" name="qtd" class="form-control" placeholder="Selecione a quantidade vendida deste produto" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" name="id" value="<?php echo $venda['id']; ?>" style="display: none;">
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Cadastrar mais Produtos à venda</button>
                                        <a href="todas-vendas.php" class="btn btn-inverse">Finalizar Cadastro</a>
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