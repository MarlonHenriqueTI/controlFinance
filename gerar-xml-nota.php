<?php 
include('header.php');

  $produtos = $_POST["produtos"]; //ok
  $qtd = $_POST["qtd"]; //ok
  //dados nota
  $operacao = $_POST["operacao"];//ok
  $natureza_operacao = $_POST["natureza_operacao"];//ok
  $modelo = 1; //ok
  $finalidade = $_POST["finalidade"];//ok
  $ambiente = $_POST["ambiente"];//ok
  //dados cliente
  $cpf_cliente = $_POST["cpf_cliente"];//ok
  $nome_cliente = $_POST["nome_cliente"];//ok
  $endereco_cliente = $_POST["endereco_cliente"];//ok
  $numero_cliente = $_POST["numero_cliente"];//ok
  $bairro_cliente = $_POST["bairro_cliente"];//ok
  $cidade_cliente = $_POST["cidade_cliente"];//ok
  $uf_cliente = $_POST["uf_cliente"];//ok
  $cep_cliente = $_POST["cep_cliente"];//xxxxx-xxx | ok
  $telefone_cliente = $_POST["telefone_cliente"];//ok
  $email_cliente = $_POST["email_cliente"];//ok
  //dados produto
  $ncm = "6109.10.00";
  $cest = "28.038.00";
  $unidade = "UN";
  $peso = "0.800"
  $origem = 0;
  $classe_imposto = "REF6082329";
  //dados pedido
  $pagamento = $_POST["pagamento"]; //numero especificando o tipo de pagamento | ok
  $presenca = $_POST["presenca"];//ok
  $modalidade_frete = 9;
  $frete = "0.00";
  $desconto = $_POST["desconto"];//ok
  //dados entrega
  $volume = $_POST["volume"];
  $especie = $_POST["especie"];
  $peso_liquido = $_POST["peso_liquido"];
  $peso_bruto = $_POST["pesobruto"];
  $cnpj_transportadora = $_POST["cnpj_transportadora"];
  $razao_social_transportadora = $_POST["razao_social_transportadora"];
  $ie_transportadora = $_POST["ie_transportadora"];
  $endereco_transportadora = $_POST["endereco_transportadora"];
  $uf_transportadora = $_POST["uf_transportadora"];
  $cidade_transportadora = $_POST["cidade_transportadora"];
  $cep_transportadora = $_POST["cep_transportadora"];

/* formatos de imagem permitidos */
$pasta = "assets/docs/";
        // Check if file is selected
if(isset($_FILES['arquivo']['name']) && $_FILES['arquivo']['size'] > 0) {

    $nome_imagem    = $_FILES['arquivo']['name'];
    $tamanho_imagem = $_FILES['arquivo']['size'];
     
    /* pega a extensão do arquivo */
    $ext = strtolower(strrchr($nome_imagem,"."));
     
         
    /* converte o tamanho para KB */
    $tamanho = round($tamanho_imagem / 1024);
 
    $arquivo = md5(uniqid(time())).$ext; 
    //nome que dará a imagem
    $tmp = $_FILES['arquivo']['tmp_name']; 
    //caminho temporário da imagem
     
    /* se enviar a foto, insere o nome da foto no banco de dados */
    if(move_uploaded_file($tmp,$pasta.$arquivo)){
    }else{
        echo "<script>alert('Falha ao enviar');</script>";
    }
}

$dados = "{\n\t\"url_notificacao\": \"http://achairprofessional.com.br/retorno.php\",\n\t\"";
$dados .= "operacao\":".$operacao.",\n\t\"";
$dados .= "natureza_operacao\":\"".$natureza_operacao."\",\n\t\"";
$dados .= "modelo\":".$modelo.",\n\t\"";
$dados .= "finalidade\":".$finalidade.",\n\t\"";
$dados .= "ambiente\":".$ambiente.",\n\t\"";
$dados .= "cliente\":{\n\t\t\"";
$dados .= "cpf\":\"".$cpf_cliente."\",\n    \t\"";
$dados .= "nome_completo\":\"".$nome_cliente."\",\n    \t\"";
$dados .= "endereco\":\"".$endereco_cliente."\",\n\t    \"";
$dados .= "numero\":".$numero_cliente.",\n\t    \"";
$dados .= "bairro\":\"".$bairro_cliente."\",\n\t    \"";
$dados .= "cidade\":\"".$cidade_cliente."\",\n\t    \"";
$dados .= "uf\":\"".$uf_cliente."\",\n\t    \"";
$dados .= "cep\":\"".$cep_cliente."\",\n\t    \"";
$dados .= "telefone\":\"".$telefone_cliente."\",\n\t    \"";
$dados .= "email\":\"".$email_cliente."\"\n\t},\n\t\"";
$dados .= "produtos\":[";
$numero_de_produtos = count($produtos);
$k = 0;
if(isset($_POST["produtos"])) {
  for ($i=0; $i < count($_POST["produtos"]); $i++) { 
    if(empty($_POST["qtd"][$i])){
        $k++;
      }
      $qtd_echo .= "| ".$_POST["qtd"][$k]." |<br>";
      $cleber = $_POST["produtos"][$i];
      $produto = selecionarUnico($conexao, 'produto', 'id', $_POST["produtos"][$i]);
      $nome_produto = $produto[0]["nome"];
      $codigo_produto = preg_replace('/[ -]+/' , '-' , $nome_produto);
      $quantidade = $_POST["qtd"][$k];
      $peso= $_POST['peso'][$k];
      $subtotal = $produto[0]["preco"];//preço da unidade
      $total_produto = $subtotal*$quantidade;
      $dados .= "{\n\t\t\"nome\": \"".$nome_produto."\",\n\t\t\"";
      $dados .= "codigo\": \"".$codigo_produto."\",\n\t\t\"";
      $dados .= "ncm\": \"".$ncm."\",\n\t\t\"";
      $dados .= "cest\": \"".$cest."\",\n\t\t\"";
      $dados .= "quantidade\": ".$quantidade.",\n\t\t\"";
      $dados .= "unidade\": \"".$unidade."\",\n\t\t\"";
      $dados .= "peso\": \"".$peso."\",\n\t\t\"";
      $dados .= "origem\": ".$origem.",\n\t\t\"";
      $dados .= "subtotal\": \"".$subtotal."\",\n\t\t\"";
      $dados .= "total\": \"".$total_produto."\",\n\t\t\"";
      if(($numero_de_produtos-1) == $i){
        $dados .= "classe_imposto\": \"".$classe_imposto."\"\n\t}],\n\t\"";
      } else {
        $dados .= "classe_imposto\": \"".$classe_imposto."\"\n\t}, \n\t";
      }
      $total = $total_produto + $total;
      $k++;
    }
  }

$total = $total - $desconto;
$dados .= "pedido\": {\n\t\t\"";
$dados .= "pagamento\": ".$pagamento.",\n\t\t\"";
$dados .= "presenca\": ".$presenca.",\n\t\t\"";
$dados .= "modalidade_frete\": ".$modalidade_frete.",\n\t\t\"";
$dados .= "frete\": \"".$frete."\",\n\t\t\"";
$dados .= "desconto\": \"".$desconto."\",\n\t\t\"";
$dados .= "total\": \"".$total."\"\n\t}\n}";
$dados .= "transporte\": {\n\t\t\"";
$dados .= "volume\": \"".$volume."\",\n\t\t\"";
$dados .= "especie\": \"".$especie."\",\n\t\t\"";
$dados .= "peso_bruto\": \"".$peso_bruto."\",\n\t\t\"";
$dados .= "peso_liquido\": \"".$peso_liquido."\",\n\t\t\"";
$dados .= "cnpj\": \"".$cnpj_transportadora."\",\n\t\t\"";
$dados .= "razao_social\": \"".$razao_social_transportadora."\",\n\t\t\"";
$dados .= "ie\": \"".$ie_transportadora."\",\n\t\t\"";
$dados .= "endereco\": \"".$endereco_transportadora."\",\n\t\t\"";
$dados .= "uf\": \"".$uf_transportadora."\",\n\t\t\"";
$dados .= "cidade\": \"".$cidade_transportadora."\",\n\t\t\"";
$dados .= "cep\": \"".$cep_transportadora."\"\n\t}\n}";


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://webmaniabr.com/api/1/nfe/emissao/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $dados,
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: 8a95fb50-80e7-b2b6-23fc-2fec372e9404",
    "x-access-token: 1782-UFyYxOvTBWMP3D4yAC0E04E6enykR9lixbBSxhXC7OuXPKed",
    "x-access-token-secret: 8lpVgdEP7momlnkYg2KGJD41f4ZvclyUdflcInxPQMxkM0Os",
    "x-consumer-key: imYQ2VXlUwVcm7VnoCPwcw7cnpO5X1gT",
    "x-consumer-secret: skvgLetUTPQrjGTBbF8pZxYgIDC7VvzB2PGw6a09Oq6dPkRa"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $resposta = json_decode($response, true);
  $data = date('Y-m-d');
  cadastrarNfe($conexao,$arquivo, $data, $resposta['uuid'], $resposta['status'], $resposta['nfe'], $resposta['serie'], $resposta['chave'], $resposta['xml'], $resposta['danfe'], $resposta['recibo'] );
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
                        <h4 class="text-themecolor">Resultado - <?php echo $resposta["status"]; ?></h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                                <li class="breadcrumb-item active">Resultado</li>
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
                        <div class="card">
                            <div class="card-body">
                              <?php 
                                foreach ($resposta as $key => $value) {
                                  echo "<strong>".$key." => </strong>".$value."<br>";
                                }
                               ?>
                               <hr>
                               <div class="row">
                                 <div class="col">
                                   <a href="notas.php" class="btn btn-success">Voltar Para As Notas</a>
                                 </div>
                                 <div class="col">
                                   <a href="<?php echo $resposta['danfe']; ?>" class="btn btn-danger" target="_blank">Baixar Nota Fiscal</a>
                                 </div>
                               </div>
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