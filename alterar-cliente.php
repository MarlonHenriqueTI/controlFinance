<?php include('header.php'); 

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $cliente = selecionarUnico($conexao, 'cliente', 'id', $id);
}

if(isset($_POST["nome"])){
    alterar($id, 'cliente', 'nome', $_POST["nome"], $conexao);


if(isset($_POST["email"])){
    alterar($id, 'cliente', 'email', $_POST["email"], $conexao);
}

if(isset($_POST["telefone"])){
    alterar($id, 'cliente', 'telefone', $_POST["telefone"], $conexao);
}

if(isset($_POST["documento"])){
    alterar($id, 'cliente', 'documento', $_POST["documento"], $conexao);
}

if(isset($_POST["nascimento"])){
    alterar($id, 'cliente', 'nascimento', $_POST["nascimento"], $conexao);
}

echo '<script>alert("Sucesso");window.location.href="todos-clientes.php";</script>';
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
                        <h4 class="text-themecolor">Alterar Cliente</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                                <li class="breadcrumb-item active">Alterar Cliente</li>
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
                                <h4 class="m-b-0 text-white">Altere seu cliente</h4>
                            </div>
                            <div class="card-body">
                                <form action="alterar-cliente.php?id=<?php echo $id; ?>" method="POST">
                                    <div class="form-body">
                                        <h3 class="card-title">Informações do cliente</h3>
                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Nome</label>
                                                    <input type="text" id="nome" class="form-control" placeholder="Nome do cliente" name="nome" required value="<?php echo $cliente[0]['nome']; ?>">
                                                </div>                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">E-mail</label>
                                                    <input type="email" id="email" class="form-control" placeholder="E-mail do cliente" name="email" value="<?php echo $cliente[0]['email']; ?>">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                             <div class="col">
                                                <div class="form-group">
                                                    <label class="control-label">Telefone</label>
                                                    <input type="text" id="telefone" class="form-control" placeholder="telefone do cliente" name="telefone" value="<?php echo $cliente[0]['telefone']; ?>">
                                                </div>                                            </div>
                                            <!--/span-->
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="control-label">Documento</label>
                                                    <input type="text" id="documento" class="form-control" placeholder="Documento do cliente" name="documento" value="<?php echo $cliente[0]['documento']; ?>">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="control-label">Nascimento</label>
                                                    <input type="date" id="nascimento" class="form-control" name="nascimento" value="<?php echo $cliente[0]['nascimento']; ?>">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                    </div>    
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Alterar Cliente</button>
                                        <a type="button" href="todos-clientes.php" class="btn btn-inverse" >Cancelar</a>
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