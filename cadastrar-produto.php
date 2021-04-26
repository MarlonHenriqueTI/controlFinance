<?php include('header.php');

$fornecedores = selecionarTodos($conexao, 'fornecedor'); 

if(isset($_POST["nome"])){

$nome = $_POST["nome"];
$descricao = $_POST["descricao"];
$quantidade = $_POST["quantidade"];
$preco = $_POST["preco"];
$sku = $_POST["sku"];
$fornecedor = $_POST["fornecedor"];
$compra = $_POST["compra"];


 /* formatos de imagem permitidos */
    $permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");
    $pasta = "assets/images/";
            // Check if file is selected
    if(isset($_FILES['foto']['name']) && $_FILES['foto']['size'] > 0) {

        $nome_imagem    = $_FILES['foto']['name'];
        $tamanho_imagem = $_FILES['foto']['size'];
         
        /* pega a extensão do arquivo */
        $ext = strtolower(strrchr($nome_imagem,"."));
         
        /*  verifica se a extensão está entre as extensões permitidas */
        if(in_array($ext,$permitidos)){
             
            /* converte o tamanho para KB */
            $tamanho = round($tamanho_imagem / 1024);
             
                $foto = md5(uniqid(time())).$ext; 
                //nome que dará a imagem
                $tmp = $_FILES['foto']['tmp_name']; 
                //caminho temporário da imagem
                 
                /* se enviar a foto, insere o nome da foto no banco de dados */
                if(move_uploaded_file($tmp,$pasta.$foto)){
                }else{
                    echo "<script>alert('Falha ao enviar');</script>";
                }
        }else{
            echo "<script>alert('Somente são aceitos arquivos do tipo Imagem');</script>";
        }
    }


    cadastrarProduto($conexao, $nome,$descricao, $foto, $quantidade, $preco, $sku, $fornecedor, $compra);

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
                        <h4 class="text-themecolor">Cadastrar Produto</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                                <li class="breadcrumb-item active">Cadastrar Produto</li>
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
                                <h4 class="m-b-0 text-white">Cadastre seu produto</h4>
                            </div>
                            <div class="card-body">
                                <form action="cadastrar-produto.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-body">
                                        <h3 class="card-title">Informações do produto</h3>
                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Nome</label>
                                                    <input type="text" id="nome" class="form-control" placeholder="Nome do produto" name="nome" required>
                                                </div>                                            
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Descrição do produto</label>
                                                    <textarea name="descricao" rows="5" class="form-control">Breve descrição do produto</textarea>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Imagem do produto</label>
                                                    <input type="file" id="foto" class="form-control" name="foto">
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Quantidade disponível</label>
                                                    <input type="number" id="quantidade" class="form-control" name="quantidade" required min="0" value="1">
                                                </div>                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Preço de Venda (Unidade)</label>
                                                    <input type="number" onchange="setTwoNumberDecimal" min="0" step="0.01" value="0.00" class="form-control" name="preco">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">SKU (Opcional) (Identificador unico do produto)</label>
                                                    <input type="text" id="sku" class="form-control" name="sku">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="control-label">Fornecedor do Produto</label>
                                                    <select name="fornecedor" class="form-control" required>
                                                        <option value="0">Fornecedor Não Cadastrado</option>
                                                        <?php foreach ($fornecedores as $key) {?>
                                                            <option value=" <?php echo $key['id']; ?> "><?php echo $key['nome']; ?></option>
                                                        <?php }  ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="control-label">Preço de compra (O preço que você paga pelo produto para o fornecedor)</label>
                                                    <input type="number" onchange="setTwoNumberDecimal" min="0" step="0.01" value="0.00" class="form-control" name="compra">
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Cadastrar Produto</button>
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