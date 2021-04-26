<?php include('header.php'); 

$vendas = selecionarUnico($conexao, 'venda', 'status', 'pendente');
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
                        <h4 class="text-themecolor">Todas as Vendas Em Debito</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                                <li class="breadcrumb-item active">Todas as Vendas Em Debito</li>
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
                                <h4 class="card-title">Todas as vendas em débito</h4>
                                <h6 class="card-subtitle">Vendas que ainda <code>não foram pagas</code></h6>
                                <div class="table-responsive">
                                     <table class="table color-bordered-table primary-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Cliente</th>
                                                <th>Produtos</th>
                                                <th>Valor Total</th>
                                                <th>Status</th>
                                                <th>Data</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php foreach ($vendas as $key) {
                                                $cliente = selecionarUnico($conexao, 'cliente', 'id', $key["id_cliente"]);
                                            ?>
                                                <tr>
                                                    <td><?php echo $key["id"]; ?></td>
                                                    <td><?php echo $cliente[0]["nome"]; ?></td>
                                                    <td><a href="#"  data-toggle="modal" <?php  echo 'data-target="#mostrar'.$key["id"].'"'; ?> >Ver Produtos</a></td>
                                                    <?php if($key["desconto_porcentagem"] != 0){
                                                            $valortotal = $key["valor_total"] - ($key["valor_total"]*($key["desconto_porcentagem"] / 100));
                                                        } else if($key["desconto_valor"] != 0){
                                                            $valortotal = $key["valor_total"] - $key["desconto_valor"];
                                                        } else {
                                                            $valortotal = $key["valor_total"];
                                                        }

                                                     ?>
                                                    <td>R$<?php echo $valortotal; ?></td>
                                                    <td><a href="#" data-toggle="modal" <?php  echo 'data-target="#alterar-status'.$key["id"].'"'; ?> >Marcar como Pago</a></td>
                                                    <td><?php echo date('d/m/Y', strtotime($key["data"])); ?></td>
                                                </tr>
                                           <?php } ?>
                                        </tbody>
                                    </table>
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
<?php foreach ($vendas as $key) { 
    $venda = selecionarUnico($conexao, 'produtos_venda', 'id_venda', $key["id"]);
?>

<!-- Modal Login -->
<div class="modal fade" <?php echo 'id="mostrar'.$key["id"].'"'; ?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color: grey;">Produtos Vendidos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
                                    <table class="table color-bordered-table primary-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Produto</th>
                                                <th>Preço (unidade)</th>
                                                <th>Quantidade vendida</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php foreach ($venda as $varios) { 
                                                $produto = selecionarUnico($conexao, 'produto', 'id', $varios["id_produto"]);
                                                ?>
                                                <tr>
                                                    <td><?php echo $produto[0]["id"]; ?></td>
                                                     <td><a href="single-produto.php?id=<?php echo $produto[0]['id']; ?>">
                                                        <?php if(!empty($produto[0]["foto"])){ ?>
                                                        <img src="assets/images/<?php echo $produto[0]['foto']; ?>" alt="user" class="img-circle" width="40"><?php } ?> <?php echo $produto[0]["nome"]; ?></a></td>
                                                    <td>R$<?php echo $produto[0]["preco"]; ?></td>
                                                    <td><?php echo $varios["quantidade"]; ?> unidades</td>
                                                </tr>
                                           <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</a>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Alterar status -->
<div class="modal fade" <?php echo 'id="alterar-status'.$key["id"].'"'; ?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color: grey;">Alterar status da venda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="alterar-status.php" method="POST">
          <div class="form-group">
           <label for="cod" style="color: grey;">Qual o status atual da venda?</label>
           <select name="status" class="form-control">
               <option value="pago">Pago</option>
               <option value="pendente">Pendente</option>
            </select>
          </div>
          <div class="form-group">
            <label>Meio de pagamento</label>
            <select name="pagamento" class="form-control">
                <option value="Ainda não foi pago">Ainda não foi pago</option>
                <option value="credito">Credito</option>
                <option value="debito">Debito</option>
                <option value="dinheiro">Dinheiro</option>
                <option value="cheque">Cheque</option>
                <option value="crediario">Crediário</option>
                <option value="outro">Outro</option>
            </select>
        </div>
      </div>
      <input type="text" name="id" style="display: none;" value="<?php  echo $key['id']; ?>">
      <div class="modal-footer">
        <a type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</a>
        <button type="submit" class="btn btn-primary">Alterar Status</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php }  ?>