<?php include('header.php'); 

$id = $_GET["id"];
$produto = selecionarUnico($conexao, 'produto', 'id', $id);
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
                        <h4 class="text-themecolor"><?php echo $produto[0]["nome"]; ?></h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                                <li class="breadcrumb-item">Estoque</li>
                                <li class="breadcrumb-item active"><?php echo $produto[0]["nome"]; ?></li>
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
                    <div class="col-12">
                        <img src="assets/images/<?php echo $produto[0]["foto"]; ?>" alt="imagem produto" style="max-width: 100%;">
                        <hr>
                    </div>
                    <div class="col">
                        <h3><?php echo $produto[0]["nome"]; ?></h3>
                        <code>SKU: <?php echo $produto[0]["SKU"]; ?></code>
                        <hr>
                    </div>
                    <div class="col-12">
                        <p><?php echo $produto[0]["descricao"]; ?></p>
                    </div>
                    <div class="col">
                        <h4>Quantidade disponivel: <?php echo $produto[0]["quantidade"]; ?> Unidades</h4>
                    </div>
                    <div class="col">
                        <h4>Preço de venda: R$<?php echo $produto[0]["preco"]; ?></h4>
                    </div>
                    <div class="col-12">
                        <hr>
                        <a href="estoque.php" class="btn btn-danger">Voltar para estoque</a>
                        <hr>
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