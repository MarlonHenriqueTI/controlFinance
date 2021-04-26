<?php include('header.php');

$fornecedores = selecionarTodos($conexao, 'fornecedor'); 

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $produto = selecionarUnico($conexao, 'produto', 'id', $id);
}

if(isset($_POST["nome"])){
    alterar($id, 'produto', 'nome', $_POST["nome"], $conexao);


if(isset($_POST["descricao"])){
    alterar($id, 'produto', 'descricao', $_POST["descricao"], $conexao);
}

if(isset($_POST["quantidade"])){
    alterar($id, 'produto', 'quantidade', $_POST["quantidade"], $conexao);
}

if(isset($_POST["preco"])){
    alterar($id, 'produto', 'preco', $_POST["preco"], $conexao);
}

if(isset($_POST["sku"])){
    alterar($id, 'produto', 'sku', $_POST["sku"], $conexao);
}

if(isset($_POST["fornecedor"])){
    alterar($id, 'produto', 'id_fornecedor', $_POST["fornecedor"], $conexao);
}

if(isset($_POST["compra"])){
    alterar($id, 'produto', 'compra', $_POST["compra"], $conexao);
}

if(isset($_FILES['foto'])){
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
    alterar($id, 'produto', 'foto', $foto, $conexao);
}

echo '<script>alert("Sucesso");window.location.href="estoque.php";</script>';
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
                        <h4 class="text-themecolor">Alterar Produto</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                                <li class="breadcrumb-item active">Alterar Produto</li>
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
                                <h4 class="m-b-0 text-white">Alterar seu produto</h4>
                            </div>
                            <div class="card-body">
                                <form action="alterar-produto.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-body">
                                        <h3 class="card-title">Informações do produto</h3>
                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Nome</label>
                                                    <input type="text" id="nome" class="form-control" placeholder="Nome do produto" name="nome" required value="<?php echo $produto[0]['nome']; ?>">
                                                </div>                                            
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Descrição do produto</label>
                                                    <textarea name="descricao" rows="5" class="form-control"><?php echo $produto[0]['descricao']; ?></textarea>
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
                                                    <input type="number" id="quantidade" class="form-control" name="quantidade" required value="<?php echo $produto[0]['quantidade']; ?>">
                                                </div>                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Preço de Venda (Unidade)</label>
                                                    <input type="number" onchange="setTwoNumberDecimal" min="0" step="0.01" class="form-control" name="preco" value="<?php echo $produto[0]['preco']; ?>">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">SKU (Opcional) (Identificador unico do produto)</label>
                                                    <input type="text" id="sku" class="form-control" name="sku" value="<?php echo $produto[0]['sku']; ?>">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="control-label">Fornecedor do Produto</label>
                                                    <select name="fornecedor" class="form-control" required>
                                                        
                                                        <?php $fornecedor = selecionarUnico($conexao, 'fornecedor', 'id', $produto[0]['id_fornecedor']); ?>
                                                        <option value=" <?php echo $fornecedor[0]['id']; ?> "><?php echo $fornecedor[0]['nome']; ?></option>
                                                            <option value="">Fornecedor Não Cadastrado</option><?php echo $fornecedor[0]['nome']; ?></option>
                                                        <?php foreach ($fornecedores as $key) {?>
                                                            <option value=" <?php echo $key['id']; ?> "><?php echo $key['nome']; ?></option>
                                                        <?php }  ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="control-label">Preço de compra (O preço que você paga pelo produto para o fornecedor)</label>
                                                    <input type="number" onchange="setTwoNumberDecimal" min="0" step="0.01" class="form-control" name="compra" value="<?php echo $produto[0]['compra']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Alterar Produto</button>
                                        <a type="button" href="estoque.php" class="btn btn-inverse" >Cancelar</a>
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