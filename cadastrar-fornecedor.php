<?php include('header.php'); 

if(isset($_POST["nome"])){

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];
    $documento = $_POST["documento"];

    $pasta = "assets/arquivos/";
            // Check if file is selected
    if(isset($_FILES['arquivo']['name']) && $_FILES['arquivo']['size'] > 0) {

        $nome_imagem    = $_FILES['arquivo']['name'];
        $tamanho_imagem = $_FILES['arquivo']['size'];
         
        /* pega a extensão do arquivo */
        $ext = strtolower(strrchr($nome_imagem,"."));
             
            /* converte o tamanho para KB */
            $tamanho = round($tamanho_imagem / 1024);
             
                $arquivo = $nome_imagem; 
                //nome que dará a imagem
                $tmp = $_FILES['arquivo']['tmp_name']; 
                //caminho temporário da imagem
                 
                /* se enviar a arquivo, insere o nome da arquivo no banco de dados */
                if(move_uploaded_file($tmp,$pasta.$arquivo)){
                }else{
                    echo "<script>alert('Falha ao enviar');</script>";
                }
    }

    cadastrarFornecedor($conexao, $nome, $email, $telefone, $endereco, $documento, $arquivo);

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
                        <h4 class="text-themecolor">Cadastrar Fornecedor</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                                <li class="breadcrumb-item active">Cadastrar Fornecedor</li>
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
                                <h4 class="m-b-0 text-white">Cadastre seu Fornecedor</h4>
                            </div>
                            <div class="card-body">
                                <form action="cadastrar-fornecedor.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-body">
                                        <h3 class="card-title">Informações do fornecedor</h3>
                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Nome</label>
                                                    <input type="text" id="nome" class="form-control" placeholder="Nome do fornecedor" name="nome" required>
                                                </div>                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">E-mail</label>
                                                    <input type="email" id="email" class="form-control" placeholder="E-mail do fornecedor" name="email">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Telefone</label>
                                                    <input type="text" id="telefone" class="form-control" placeholder="telefone do fornecedor" name="telefone">
                                                </div>                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Documento</label>
                                                    <input type="text" id="documento" class="form-control" placeholder="Documento do fornecedor" name="documento">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="control-label">Endereço</label>
                                                    <input type="text" id="endereço" class="form-control" placeholder="Endereço do fornecedor" name="endereco">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="control-label">arquivo</label>
                                                    <input type="file" id="arquivo" class="form-control" name="arquivo">
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Cadastrar Fornecedor</button>
                                        <a type="button" href="index.php" class="btn btn-inverse" >Cancelar</a>
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