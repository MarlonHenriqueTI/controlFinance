$config = [
   "atualizacao" => "2018-02-06 06:01:21",
   "tpAmb" => 2, // Se deixar o tpAmb como 2 você emitirá a nota em ambiente de homologação(teste) e as notas fiscais aqui não tem valor fiscal
   "razaosocial" => "Empresa teste",
   "siglaUF" => "RS",
   "cnpj" => "78767865000156",
   "schemes" => "PL_008i2",
   "versao" => "4.00",
   "tokenIBPT" => "AAAAAAA"
];
$configJson = json_encode($config);

$certificadoDigital = file_get_contents('assets/docs/ALINE FREITAS LIMA27370658000141.pfx');

$tools = new NFePHP\NFe\Tools($configJson, NFePHP\Common\Certificate::readPfx($certificadoDigital, '1234'));
$xmlAssinado = $tools->signNFe($xml);

$idLote = str_pad(100, 15, '0', STR_PAD_LEFT); // Identificador do lote
$resp = $tools->sefazEnviaLote([$xmlAssinado], $idLote);

$st = new NFePHP\NFe\Common\Standardize();
$std = $st->toStd($resp);
if ($std->cStat != 103) {
   //erro registrar e voltar
   exit("[$std->cStat] $std->xMotivo");
}
$recibo = $std->infRec->nRec; // Vamos usar a variável $recibo para consultar o status da nota
$protocolo = $tools->seFazConsultaRecibo($recibo);
$protocol = new NFePHP\NFe\Factories\Protocol();
$xmlProtocolado = $protocol->add($xmlAssinado,$protocolo);
file_put_contents('nota.xml',$xmlProtocolado);
