<?php include('header.php'); 

$cidades = selecionarTodos($conexao, 'municipio');
$estados = selecionarTodos($conexao, 'uf');
$produtos = selecionarTodos($conexao, 'produto');
$clientes = selecionarTodos($conexao, 'cliente');
$nfe = selecionarUltimaNota($conexao);
if(isset($_POST["id"])){
  $cliente = selecionarUnico($conexao, 'cliente', 'id', $_POST['id']);
  
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
                <h4 class="text-themecolor">Gerar Nota Fiscal Eletronica</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                        <li class="breadcrumb-item active">Gerar Nota Fiscal</li>
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
                      <?php if(!isset($_POST['id'])){ ?>
                      <form action="gerar-nota.php" method="post">
                        <div class="row">
                          <div class="col">
                                  <div class="form-group">
                                      <label>Selecione um cliente cadastrado no sistema ou desça a pagina para preencher manualmente</label>
                                      <select name="id" class="js-example-basic-single form-control">
                                        <option value="">Selecione o cliente</option>
                                        <?php foreach ($clientes as $key) {?>
                                            <option value=" <?php echo $key['id']; ?> "><?php echo $key['nome']." documento: ".$key['documento']; ?></option>
                                        <?php } ?>
                                       </select>
                                  </div> 
                        </div>
                        <div class="col">
                        <button type="submit" class="btn btn-success">Selecionar Este Cliente</button>
                        </div>
                      </div>
                      </form>
                    <?php } ?>
                        <form action="gerar-xml-nota.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                               <div class="col">
                                   <div class="form-group">
                                       <label>Ambiente de envio</label>
                                       <select name="ambiente" class="form-control" required id="estado">
                                        <option value="2">Testes</option>
                                        <option value="1">Envio real</option>
                                       </select>
                                   </div>
                               </div>
                           </div>
                           <div class="row">
                            <div class="col">
                              <h4>Ultima nota gerada: <span style="color:orange;"><?php echo $nfe['numero']; ?></span></h4>
                            </div>
                           </div>
                           <hr>
                           <h4>Dados Gerais</h4>
                           <hr>
                           <div class="row">
                               <div class="col-5">
                                   <div class="form-group">
                                       <label>Natureza da operação:</label>
                                       <select name="natureza_operacao" class="js-example-basic-single" required id="natureza">
                                        <option value="Compra para comercialização">1102 - Compra para comercialização</option>
                                        <option value="Devolução de venda de mercadoria">1202 - Devolução de venda de mercadoria</option>
                                        <option value="Retorno de remessa p/ demonstr.">1913 - Retorno de remessa p/ demonstr.</option>
                                        <option value="Retorno de remessa p/ conserto">1915 - Retorno de remessa p/ conserto</option>
                                        <option value="Compra para comercialização">2102 - Compra para comercialização</option>
                                        <option value="Devolução de venda de mercadoria">2202 - Devolução de venda de mercadoria</option>
                                        <option value="Retorno de remessa p/ demonstr.">2913 - Retorno de remessa p/ demonstr.</option>
                                        <option value="Retorno de remessa p/ conserto">2915 - Retorno de remessa p/ conserto</option>
                                        <option value="Compra (do exterior) para comercialização">3102 - Compra (do exterior) para comercialização</option>
                                        <option value="Venda de mercadoria" selected="selected">5102 - Venda de mercadoria</option>
                                        <option value="Devolução de compra">5202 - Devolução de compra</option>
                                        <option value="Venda de bem do ativo imobilizado.">5551 - Venda de bem do ativo imobilizado.</option>
                                        <option value="Remessa por comodato">5908 - Remessa por comodato</option>
                                        <option value="Remessa p/ demonstração">5912 - Remessa p/ demonstração</option>
                                        <option value="Remessa p/ conserto">5915 - Remessa p/ conserto</option>
                                        <option value="Venda para entrega futura">5922 - Venda para entrega futura</option>
                                        <option value="Outra saída de mercadoria">5949 - Outra saída de mercadoria</option>
                                        <option value="Venda de mercadoria">6102 - Venda de mercadoria</option>
                                        <option value="Devolução de compra">6202 - Devolução de compra</option>
                                        <option value="Venda de bem do ativo imobilizado.">6551 - Venda de bem do ativo imobilizado.</option>
                                        <option value="Remessa por comodato">6908 - Remessa por comodato</option>
                                        <option value="Remessa p/ demonstração">6912 - Remessa p/ demonstração</option>
                                        <option value="Remessa p/ conserto">6915 - Remessa p/ conserto</option>
                                        <option value="Venda para entrega futura">6922 - Venda para entrega futura</option>
                                        <option value="Outra saída de mercadoria">6949 - Outra saída de mercadoria</option>
                                        <option value="Estorno de NFe não cancelada no prazo legal">999 - Estorno de NFe não cancelada no prazo legal</option>
                                        <option value="Complemento de tributo (p/ NFe complementar)">Complemento de tributo (p/ NFe complementar)</option>
                                        <option value="Complemento de quantidade (p/ NFe complementar)">Complemento de quantidade (p/ NFe complementar)</option>
                                        <option value="Complemento de valor (p/ NFe complementar)">Complemento de valor (p/ NFe complementar)</option>
                                       </select>
                                   </div>
                               </div>
                               <div class="col">
                                   <div class="form-group">
                                       <label>Tipo de Operação:</label>
                                       <select name="operacao" class="form-control" required id="estado">
                                        <option value="0">Entrada</option>
                                        <option value="1" selected="selected">Saída</option>
                                       </select>
                                   </div>
                               </div>
                               <div class="col">
                                   <div class="form-group">
                                       <label>Local:</label>
                                       <select name="operacao" class="form-control" required id="estado">
                                        <option value="estadual">estadual</option>
                                        <option value="interestadual">interestadual</option>
                                       </select>
                                   </div>
                               </div>
                               <div class="col-3">
                                   <div class="form-group">
                                       <label for="Finalidade da emissão">Finalidade da emissão</label>
                                       <select id="BfinNFe" class="form-control" name="finalidade" autocomplete="off">
                                            <option value="1" selected="selected">Normal</option>
                                            <option value="2">Complementar</option>
                                            <option value="3">De ajuste</option>
                                            <option value="4">Devolução de mercadoria</option>
                                        </select>
                                   </div>
                               </div>
                               
                               <div class="col-4">
                                   <div class="form-group">
                                        <label >Presença Comprador</label>
                                       <select id="BindPres" class="form-control" name="presenca" autocomplete="off">
                                            <option value="0">Não se aplica</option>
                                            <option value="1" selected>Operação presencial</option>
                                            <option value="2">Operação não presencial, pela Internet</option>
                                            <option value="3">Operação não presencial, teleatendimento</option>
                                            <option value="4">NFC-e em operação com entrega a domicílio</option>
                                            <option value="5">Operação presencial, fora do estabelecimento</option>
                                            <option value="9">Operação não presencial, outros</option>
                                        </select>
                                   </div>
                               </div>
                               <div class="col-4">
                                   <div class="form-group">
                                        <label >Pagamento</label>
                                       <select id="BindPres" class="form-control" name="pagamento" autocomplete="off">
                                            <option value="0" selected>Pagamento à vista</option>
                                            <option value="1">Pagamento a prazo</option>
                                        </select>
                                   </div>
                               </div>
                               <div class="col-4">
                                   <div class="form-group">
                                       <label>Desconto</label>
                                       <input type="number" id="desconto" class="form-control" name="desconto">
                                   </div>
                               </div>
                           </div>
                           <hr>
                           <h4>Dados do Destinatário</h4>
                           <hr>
                           <?php if(!isset($_POST['id'])){ ?>
                           <div class="row">
                                <div class="col-3">
                                  <div class="form-group">
                                      <label>Nome / Razão Cliente</label>
                                      <input type="text" id="nome_cliente" class="form-control" name="nome_cliente" autocomplete="off" minsize="2" maxsize="60" hiddenid="meuCodDest" allowzero="true" required>
                                  </div> 
                                </div>
                                <div class="col-3">
                                  <div class="form-group">
                                      <label>CNPJ/CPF destinatário</label>
                                      <input type="text" id="cpf_cliente" class="form-control" name="cpf_cliente" autocomplete="off" especialtype="cpfcnpj">
                                  </div> 
                                </div>
                                <div class="col-3">
                                  <div class="form-group">
                                      <label>Telefone</label>
                                      <input type="text" id="telefone_cliente" class="form-control" name="telefone_cliente" autocomplete="off" especialtype="integer" minsize="6" maxsize="14">
                                  </div> 
                                </div>
                                 <div class="col-3">
                                  <div class="form-group">
                                      <label>E-mail</label>
                                      <input type="text" id="email_cliente" class="form-control" name="email_cliente" autocomplete="off" especialtype="email" maxsize="60">
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
                           </div>
                         <?php } else { ?>
                          <div class="row">
                                <div class="col-3">
                                  <div class="form-group">
                                      <label>Nome / Razão Cliente</label>
                                      <input type="text" id="nome_cliente" class="form-control" name="nome_cliente" value="<?php echo $cliente[0]["nome"]; ?>" required>
                                  </div> 
                                </div>
                                <div class="col-3">
                                  <div class="form-group">
                                      <label>CNPJ/CPF destinatário</label>
                                      <input type="text" id="cpf_cliente" class="form-control" name="cpf_cliente" value="<?php echo $cliente[0]["documento"]; ?>" especialtype="cpfcnpj">
                                  </div> 
                                </div>
                                <div class="col-3">
                                  <div class="form-group">
                                      <label>Telefone</label>
                                      <input type="text" id="telefone_cliente" class="form-control" name="telefone_cliente" autocomplete="off" especialtype="integer" minsize="6" maxsize="14" value="<?php echo $cliente[0]["telefone"]; ?>">
                                  </div> 
                                </div>
                                 <div class="col-3">
                                  <div class="form-group">
                                      <label>E-mail</label>
                                      <input type="text" id="email_cliente" class="form-control" name="email_cliente" autocomplete="off" especialtype="email" maxsize="60" value="<?php echo $cliente[0]["email"]; ?>">
                                  </div> 
                                </div>
                                <div class="col-12">
                                  <div class="form-group">
                                      <label>Endereço Cliente</label>
                                      <input type="text" id="endereco_cliente" class="form-control" name="endereco_cliente" required value="<?php echo $cliente[0]["endereco"]; ?>">
                                  </div> 
                                </div>
                                <div class="col-3">
                                  <div class="form-group">
                                      <label>Número</label>
                                      <input type="text" id="numero_cliente" class="form-control" name="numero_cliente" autocomplete="off" especialtype="string" maxsize="60" required value="<?php echo $cliente[0]["numero"]; ?>">
                                  </div> 
                                </div>
                                <div class="col-3">
                                  <div class="form-group">
                                      <label>Complemento</label>
                                      <input type="text" id="ExCpl" class="form-control" name="ExCpl" autocomplete="off" especialtype="string" maxsize="60" value="<?php echo $cliente[0]["complemento"]; ?>">
                                  </div> 
                                </div>
                                <div class="col-3">
                                  <div class="form-group">
                                      <label>Bairro</label>
                                      <input type="text" id="bairro_cliente" class="form-control" name="bairro_cliente" autocomplete="off" especialtype="string" minsize="2" maxsize="60" required value="<?php echo $cliente[0]["bairro"]; ?>">
                                  </div> 
                                </div>
                                <div class="col-3">
                                  <div class="form-group">
                                      <label>CEP</label>
                                      <input type="text" id="cep" class="form-control" name="cep_cliente" autocomplete="off" especialtype="integer" exactsize="8" value="<?php echo $cliente[0]["cep"]; ?>">
                                  </div> 
                                </div>
                                <div class="col">
                                  <div class="form-group">
                                      <label>Estado</label>
                                      <select id="uf_cliente" class="form-control" name="uf_cliente" autocomplete="off">
                            
                                        <option value="<?php echo $cliente[0]["estado"]; ?>" selected=""> <?php echo $cliente[0]["estado"]; ?> </option><option value="AC">AC</option><option value="AL">AL</option><option value="AM">AM</option><option value="AP">AP</option><option value="BA">BA</option><option value="CE">CE</option><option value="DF">DF</option><option value="ES">ES</option><option value="GO">GO</option><option value="MA">MA</option><option value="MG">MG</option><option value="MS">MS</option><option value="MT">MT</option><option value="PA">PA</option><option value="PB">PB</option><option value="PE">PE</option><option value="PI">PI</option><option value="PR">PR</option><option value="RJ">RJ</option><option value="RN">RN</option><option value="RO">RO</option><option value="RR">RR</option><option value="RS">RS</option><option value="SC">SC</option><option value="SE">SE</option><option value="SP">SP</option><option value="TO">TO</option><option value="EX">EX</option></select>
                                  </div> 
                                </div>
                                <div class="col">
                                  <div class="form-group">
                                      <label>Municipio</label>
                                      <select name="cidade_cliente" class="js-example-basic-single form-control">
                                        <option value="">Selecione a cidade</option>
                                        <option value="<?php echo $cliente[0]["municipio"]; ?>" selected><?php echo $cliente[0]["municipio"]; ?></option>
                                        <?php foreach ($cidades as $key) {?>
                                            <option value=" <?php echo $key['nome']; ?> "><?php echo $key['nome']; ?></option>
                                        <?php } ?>
                                       </select>
                                  </div> 
                                </div>
                           </div>
                         <?php } ?>
                           <hr>
                           <h4>Lista de Produtos - Selecione os produtos vendidos e a quantidade</h4>
                           <hr>
                           <div class="row">
                              <div class="container">
                                <table id="myTable" class=" table order-list table-striped table-hover">
                                <thead>
                                    <tr>
                                        <td class="col">Selecionar Produto</td>
                                        <td class="col-3">Quantidade</td>
                                        <td class="col-3">Peso</td>
                                    </tr>
                                </thead>
                                <tbody>
                                  <div class="container">
                                    <?php foreach ($produtos as $key) {?>
                                      <tr>
                                        <td class="form-check col">
                                          <input type="checkbox" class="form-check-input" id="exampleCheck1" name="produtos[]" value="<?php echo $key['id']; ?>">
                                          <label class="form-check-label" for="exampleCheck1"><?php echo $key["nome"]." | R$".$key["preco"]; ?></label>
                                        </td>
                                        <td class="form-group col-3">
                                          <input type="number" name="qtd[]" class="form-control" min="0" max="<?php echo $key['quantidade']; ?>" placeholder="0">
                                        </td>
                                        <td class="form-group col-3">
                                          <input type="number" name="peso[]" class="form-control" value="0.800" step="0.001">
                                        </td>
                                      </tr>
                                    <?php } ?>
                                  </div>
                                </tbody>
                            </table>
                            </div> 
                           </div>
                           <hr>
                           <h4>Informações de Transporte</h4>
                           <hr>
                           <div class="row">
                            <div class="col-3">
                                  <div class="form-group">
                                      <label>Volume</label>
                                      <input type="number" id="volume" class="form-control" name="volume" autocomplete="off" minsize="2" maxsize="60" hiddenid="meuCodDest" allowzero="true" required>
                                  </div> 
                                </div>
                                <div class="col-3">
                                  <div class="form-group">
                                      <label>Especie</label>
                                      <input type="text" id="especie" class="form-control" name="especie" autocomplete="off" minsize="2" maxsize="60" hiddenid="meuCodDest" allowzero="true" required>
                                  </div> 
                                </div>
                                <div class="col-3">
                                  <div class="form-group">
                                      <label>Peso Bruto</label>
                                      <input type="number" name="pesobruto" class="form-control" value="0.800" step="0.001">
                                  </div> 
                                </div>
                                <div class="col-3">
                                  <div class="form-group">
                                      <label>Peso Liquido</label>
                                      <input type="number" name="peso_liquido" class="form-control" value="0.800" step="0.001">
                                  </div> 
                                </div>
                                <div class="col-3">
                                  <div class="form-group">
                                      <label>Nome / Razão Transportadora</label>
                                      <input type="text" id="razao_social_transportadora" class="form-control" name="razao_social_transportadora" autocomplete="off" minsize="2" maxsize="60" hiddenid="meuCodDest" allowzero="true" required>
                                  </div> 
                                </div>
                                <div class="col-3">
                                  <div class="form-group">
                                      <label>CNPJ transportadora</label>
                                      <input type="text" id="cnpj_transportadora" class="form-control" name="cnpj_transportadora" autocomplete="off" especialtype="cpfcnpj">
                                  </div> 
                                </div>
                                <div class="col-3">
                                  <div class="form-group">
                                      <label>ie transportadora</label>
                                      <input type="text" id="ie_transportadora" class="form-control" name="ie_transportadora" autocomplete="off">
                                  </div> 
                                </div>
                                <div class="col-12">
                                  <div class="form-group">
                                      <label>Endereço Transportadora</label>
                                      <input type="text" id="endereco_transportadora" class="form-control" name="endereco_transportadora" required>
                                  </div> 
                                </div>
                                <div class="col-3">
                                  <div class="form-group">
                                      <label>CEP Transportadora</label>
                                      <input type="text" id="cep_transportadora" class="form-control" name="cep_transportadora" autocomplete="off" especialtype="integer" exactsize="8">
                                  </div> 
                                </div>
                                <div class="col">
                                  <div class="form-group">
                                      <label>Estado</label>
                                      <select id="uf_transportadora" class="form-control" name="uf_transportadora" autocomplete="off"><option value=""></option><option value="AC">AC</option><option value="AL">AL</option><option value="AM">AM</option><option value="AP">AP</option><option value="BA">BA</option><option value="CE">CE</option><option value="DF">DF</option><option value="ES">ES</option><option value="GO">GO</option><option value="MA">MA</option><option value="MG">MG</option><option value="MS">MS</option><option value="MT">MT</option><option value="PA">PA</option><option value="PB">PB</option><option value="PE">PE</option><option value="PI">PI</option><option value="PR">PR</option><option value="RJ">RJ</option><option value="RN">RN</option><option value="RO">RO</option><option value="RR">RR</option><option value="RS">RS</option><option value="SC">SC</option><option value="SE">SE</option><option value="SP">SP</option><option value="TO">TO</option><option value="EX">EX</option></select>
                                  </div> 
                                </div>
                                <div class="col">
                                  <div class="form-group">
                                      <label>Municipio</label>
                                      <select name="cidade_transportadora" class="js-example-basic-single form-control">
                                        <option value="">Selecione a cidade</option>
                                        <?php foreach ($cidades as $key) {?>
                                            <option value=" <?php echo $key['nome']; ?> "><?php echo $key['nome']; ?></option>
                                        <?php } ?>
                                       </select>
                                  </div> 
                                </div>
                           </div>
                           <hr>
                           <h4>Outras Informações</h4>
                           <hr>
                           <div class="row">
                               <div class="col">
                                   <div class="form-group">
                                       <label>Informações Complementares</label>
                                       <textarea name="infoComplementares" id="" rows="5" class="form-control">EMPRESA OPTANTE PELO SIMPLES NACIONAL ISENTO ICMS DECRETO 24569 DE 97 ARTIGO VI PARAGRAFO II.</textarea>
                                   </div>
                               </div>
                               <div class="col">
                                   <div class="form-group">
                                       <label>Informações para o Fisco</label>
                                       <textarea name="infoFisco" id="" rows="5" class="form-control"></textarea>
                                   </div>
                               </div>
                           </div>
                           <div class="row">
                             <div class="col">
                               <div class="form-group">
                                  <label>Se você desejar pode subir um arquivo:</label>
                                  <input type="file" name="arquivo" class="form-control">
                               </div>
                             </div>
                           </div>
                           <button type="submit" class="btn btn-success">Salvar e enviar nota</button>
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