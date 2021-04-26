<?php include('header.php'); 

$cidades = selecionarTodos($conexao, 'municipio');
$estados = selecionarTodos($conexao, 'uf');

if(isset($_POST["nome"])){
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $documento = $_POST["documento"];
    $nascimento = $_POST["nascimento"];
    $endereco = $_POST["endereco_cliente"];//ok
  $numero = $_POST["numero_cliente"];//ok
  $bairro = $_POST["bairro_cliente"];//ok
  $municipio = $_POST["cidade_cliente"];//ok
  $estado = $_POST["uf_cliente"];//ok
  $cep = $_POST["cep_cliente"];//xxxxx-xxx | ok

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

    cadastrarCliente($conexao, $nome, $email, $telefone, $documento, $nascimento, $arquivo, $endereco, $numero, $complemento, $bairro, $cep, $estado, $municipio);
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
                        <h4 class="text-themecolor">Cadastrar Cliente</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                                <li class="breadcrumb-item active">Cadastrar Cliente</li>
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
                                <h4 class="m-b-0 text-white">Cadastre seu cliente</h4>
                            </div>
                            <div class="card-body">
                                <form action="cadastrar-cliente.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-body">
                                        <h3 class="card-title">Informações do cliente</h3>
                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Nome</label>
                                                    <input type="text" id="nome" class="form-control" placeholder="Nome do cliente" name="nome" required>
                                                </div>                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">E-mail</label>
                                                    <input type="email" id="email" class="form-control" placeholder="E-mail do cliente" name="email">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                             <div class="col">
                                                <div class="form-group">
                                                    <label class="control-label">Telefone</label>
                                                    <input type="text" id="telefone" class="form-control" placeholder="telefone do cliente" name="telefone">
                                                </div>                                            </div>
                                            <!--/span-->
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="control-label">Documento</label>
                                                    <input type="text" id="documento" class="form-control" placeholder="Documento do cliente" name="documento">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="control-label">Nascimento</label>
                                                    <input type="date" id="nascimento" class="form-control" name="nascimento">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                  <div class="form-group">
                                      <label>Endereço Cliente</label>
                                      <input type="text" id="endereco_cliente" class="form-control" name="endereco_cliente" required>
                                  </div> 
                                </div>
                                <div class="col-3">
                                  <div class="form-group">
                                      <label>Número</label>
                                      <input type="text" id="numero_cliente" class="form-control" name="numero_cliente" autocomplete="off" especialtype="string" maxsize="60" required>
                                  </div> 
                                </div>
                                <div class="col-3">
                                  <div class="form-group">
                                      <label>Complemento</label>
                                      <input type="text" id="ExCpl" class="form-control" name="ExCpl" autocomplete="off" especialtype="string" maxsize="60">
                                  </div> 
                                </div>
                                <div class="col-3">
                                  <div class="form-group">
                                      <label>Bairro</label>
                                      <input type="text" id="bairro_cliente" class="form-control" name="bairro_cliente" autocomplete="off" especialtype="string" minsize="2" maxsize="60" required>
                                  </div> 
                                </div>
                                <div class="col-3">
                                  <div class="form-group">
                                      <label>CEP</label>
                                      <input type="text" id="cep" class="form-control" name="cep_cliente" autocomplete="off" especialtype="integer" exactsize="8">
                                  </div> 
                                </div>
                                <div class="col">
                                  <div class="form-group">
                                      <label>Estado</label>
                                      <select id="uf_cliente" class="form-control" name="uf_cliente" autocomplete="off"><option value=""></option><option value="AC">AC</option><option value="AL">AL</option><option value="AM">AM</option><option value="AP">AP</option><option value="BA">BA</option><option value="CE">CE</option><option value="DF">DF</option><option value="ES">ES</option><option value="GO">GO</option><option value="MA">MA</option><option value="MG">MG</option><option value="MS">MS</option><option value="MT">MT</option><option value="PA">PA</option><option value="PB">PB</option><option value="PE">PE</option><option value="PI">PI</option><option value="PR">PR</option><option value="RJ">RJ</option><option value="RN">RN</option><option value="RO">RO</option><option value="RR">RR</option><option value="RS">RS</option><option value="SC">SC</option><option value="SE">SE</option><option value="SP">SP</option><option value="TO">TO</option><option value="EX">EX</option></select>
                                  </div> 
                                </div>
                                <div class="col">
                                  <div class="form-group">
                                      <label>Municipio</label>
                                      <select name="cidade_cliente" class="js-example-basic-single form-control">
                                        <option value="">Selecione a cidade</option>
                                        <?php foreach ($cidades as $key) {?>
                                            <option value=" <?php echo $key['nome']; ?> "><?php echo $key['nome']; ?></option>
                                        <?php } ?>
                                       </select>
                                  </div> 
                                </div>
                                            <!--/span-->
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="control-label">arquivo</label>
                                                    <input type="file" id="arquivo" class="form-control" name="arquivo">
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Cadastrar Cliente</button>
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