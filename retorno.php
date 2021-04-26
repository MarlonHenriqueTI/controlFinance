<?php 
include('bancodedados/conecta-db.php');
include('funcoes.php');

$cnpj = $_POST["CNPJ"];
$rSocial = $_POST["rSocial"];
$fantasia = $_POST["fantasia"];
$IE = $_POST["IE"];
$IM = $_POST["IM"];
$CNAE = $_POST["CNAE"];
$telefone = $_POST["telefone"];
$bairro = $_POST["bairro"];
$endereco = $_POST["endereco"];
$cMunicipio = $_POST["cidade"];
$munFatoGerador = $_POST["mun"];
$cUF = $_POST["uf"];
$cep = $_POST["cep"];
$crt = $_POST["crt"];
$modeloNota = $_POST["modeloNota"];
$serieNota = $_POST["serieNota"];
$ambiente = $_POST["ambiente"]; //teste ou real
$numeroNFe = $_POST["numeroNFe"];
$natureza = $_POST["natureza"];
$consumidorFinal = $_POST["consumidorFinal"];
$tipoOperacao = $_POST["tipoOperacao"]; //entrada ou saida
$BfinNFe = $_POST["BfinNFe"]; //finalidade
$BidDest = $_POST["BidDest"]; //Destino de operação
$nfreferenciada = $_POST["nfreferenciada"];
$dataEmissao = $_POST["dataEmissao"];
$horaEmissao = $_POST["horaEmissao"];
$dataEmissaosaida = $_POST["dataEmissaosaida"];
$horaEmissaosaida = $_POST["horaEmissaosaida"];
$BindPres = $_POST["BindPres"]; //Presença do comprador
$CIEST = $_POST["CIEST"]; //Inst.Est.Subst. Trib

//dados destinatario
$ExNome = $_POST["ExNome"];
$ECNPJ = $_POST["ECNPJ"];
$Efone = $_POST["Efone"];
$Eemail = $_POST["Eemail"];
$EISUF = $_POST["EISUF"]; //suframa
$ExLgr = $_POST["ExLgr"]; //logradouro
$Enro = $_POST["Enro"]; //numero
$ExCpl = $_POST["ExCpl"]; //complemento
$ExBairro = $_POST["ExBairro"];
$ECEP = $_POST["ECEP"];
$EUF = $_POST["EUF"]; //siglas dos estados
$ecmun = $_POST["ecmun"]; //municipio codigo
$EindIEDest = $_POST["EindIEDest"]; //indicador de IE
$EIE = $_POST["EIE"]; //IE
$EIM = $_POST["EIM"]; //IM
$produtos = $_POST["produtos"];
$qtd = $_POST["qtd"];

$infoComplementares = $_POST["infoComplementares"];
$infoFisco = $_POST["infoFisco"];

$produto = selecionarUnico($conexao, 'produto', 'id', $produtos);
$cidade = selecionarUnico($conexao, 'municipio', 'id', $cMunicipio);
$estado = selecionarUnico($conexao, 'uf', 'id', $cUF);

$valores = '{
  "url_notificacao": "http://controlfinance.marlonhenrique.com/retorno.php",
  "operacao": '.$tipoOperacao.',
  "natureza_operacao": '.$natureza.',
  "modelo": '.$modeloNota.',
  "finalidade": '.$BfinNFe.',
  "ambiente": '.$ambiente.',
  "cliente": {
    "cpf": "023.781.973-22",
    "nome_completo": "Claudemir Alves de Lima",
    "endereco": "Rua Francisco Gonçalves Nero",
    "complemento": "",
    "numero": 1242,
    "bairro": "Renascer",
    "cidade": "Quixada",
    "uf": "CE",
    "cep": "63950-000",
    "telefone": "(11)97774-9858",
    "email": "claudemir.m.dias@gmail.com"
  },
  "produtos": [{
    "nome": "Nome do produto",
    "codigo": "nome-do-produto",
    "ncm": "6109.10.00",
    "cest": "28.038.00",
    "quantidade": 3,
    "unidade": "UN",
    "peso": "0.800",
    "origem": 0,
    "subtotal": "44.90",
    "total": "134.70",
    "classe_imposto": "REF6082329"
  }, 
  {
    "nome": "Nome do produto",
    "codigo": "nome-do-produto",
    "ncm": "6109.10.00",
    "cest": "28.038.00",
    "quantidade": 1,
    "unidade": "UN",
    "peso": "0.800",
    "origem": 0,
    "subtotal": "29.90",
    "total": "29.90",
    "classe_imposto": "REF6082329"
  }],
  "pedido": {
    "pagamento": 0,
    "presenca": 1,
    "modalidade_frete": 9,
    "frete": "0.00",
    "desconto": "10.00",
    "total": "174.60"
  }
}';

$data = json_decode($valores, true);

require_once __DIR__ . '/nfe.php';
use WebmaniaBR\NFe;

$webmaniabr = new NFe('imYQ2VXlUwVcm7VnoCPwcw7cnpO5X1gT', 'skvgLetUTPQrjGTBbF8pZxYgIDC7VvzB2PGw6a09Oq6dPkRa', '1782-UFyYxOvTBWMP3D4yAC0E04E6enykR9lixbBSxhXC7OuXPKed', '8lpVgdEP7momlnkYg2KGJD41f4ZvclyUdflcInxPQMxkM0Os');

$resp = $webmaniabr->emissaoNotaFiscal( $data );

if($resp->error) {

   echo 'Ocorreu um erro: ' . $resp->error;

}else{

    echo $response->uuid; // Número único de identificação da Nota Fiscal
    echo $response->status; // aprovado, reprovado, cancelado, processamento ou contingencia
    echo $response->nfe; // Número da NF-e
    echo $response->serie; // Número de série
    echo $response->recibo; // Número do recibo
    echo $response->chave; // Número da chave de acesso
    echo $response->xml; // URL do XML
    echo $response->danfe; // URL do Danfe (PDF)
    echo $response->log; // Log do Sefaz

}