<?php include('header.php'); 

$vendas = selecionarUltimosLimite($conexao, 'venda', 10);
?>
        
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="min-height: 595px;">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Inicio</h4>
                    </div>
                    
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Info box -->
                <!-- ============================================================== -->
                <div class="card-group">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex no-block align-items-center">
                                        <div>
                                            <h3><i class="icon-basket-loaded"></i></h3>
                                            <p class="text-muted">Total Vendas</p>
                                        </div>
                                        <div class="ml-auto">
                                            <h2 class="counter text-primary"><?php echo count(selecionarTodos($conexao, "venda")); ?></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex no-block align-items-center">
                                        <div>
                                            <h3><i class="icon-basket"></i></h3>
                                            <p class="text-muted">Vendas (30 dias)</p>
                                        </div>
                                        <div class="ml-auto">
                                            <h2 class="counter text-cyan"><?php echo count(selecionarTodosPeriodo($conexao, 'venda', date('Y-m-d', '-30 days'), date('Y-m-d'))); ?></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-cyan" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex no-block align-items-center">
                                        <div>
                                            <h3><i class="icon-drawar"></i></h3>
                                            <p class="text-muted">Produtos Cadastrados</p>
                                        </div>
                                        <div class="ml-auto">
                                            <h2 class="counter text-purple"><?php echo count(selecionarTodos($conexao, "produto")); ?></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-purple" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex no-block align-items-center">
                                        <div>
                                            <h3><i class="icon-user"></i></h3>
                                            <p class="text-muted">Clientes Cadastrados</p>
                                        </div>
                                        <div class="ml-auto">
                                            <h2 class="counter text-success"><?php echo count(selecionarTodos($conexao, "cliente")); ?></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Info box -->
                <!-- ============================================================== -->
                
                <!-- ============================================================== -->
                <!-- Review -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Ultimas Vendas</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cliente</th>
                                            <th>Produto</th>
                                            <th>Data</th>
                                            <th>Valor</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($vendas as $key) {
                                                $cliente = selecionarUnico($conexao, 'cliente', 'id', $key["id_cliente"]);
                                            ?>
                                        <tr>
                                             <td><?php echo "#".$key["id"]; ?></td>
                                            <td><?php echo $cliente[0]["nome"]; ?></td>
                                            <td><a href="#"  data-toggle="modal" <?php  echo 'data-target="#mostrar'.$key["id"].'"'; ?> >Ver Produtos</a></td>
                                            <td><span class="text-muted"><i class="fa fa-clock-o"></i> <?php echo date('d/m/Y', strtotime($key["data"])); ?></span></td>
                                             <?php if($key["desconto_porcentagem"] != 0){
                                                            $valortotal = $key["valor_total"] - ($key["valor_total"]*($key["desconto_porcentagem"] / 100));
                                                        } else if($key["desconto_valor"] != 0){
                                                            $valortotal = $key["valor_total"] - $key["desconto_valor"];
                                                        } else {
                                                            $valortotal = $key["valor_total"];
                                                        }

                                                     ?>
                                                    <td>R$<?php echo $valortotal; ?></td>
                                                    <?php if($key["status"] == "pago"){ ?>
                                                    <td class="text-center">
                                                        <div class="label label-table label-success">Pago</div>
                                                    </td>
                                                    <?php } else { ?>
                                                    <td class="text-center">
                                                        <div class="label label-table label-warning">Pendente</div>
                                                    </td>
                                                    <?php } ?>         
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- ============================================================== -->
                <!-- End Review -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Comment - chats -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- End Comment - chats -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- End Page Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <div class="right-sidebar ps ps--theme_default" data-ps-id="7934a0dd-1624-4685-e3e5-1334c704f2a8">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul class="m-t-20" id="themecolors">
                                <li><b>With Light sidebar</b></li>
                                <li><a class="default-theme working" href="javascript:void(0)" data-skin="skin-default">1</a></li>
                                <li><a class="green-theme" href="javascript:void(0)" data-skin="skin-green">2</a></li>
                                <li><a class="red-theme" href="javascript:void(0)" data-skin="skin-red">3</a></li>
                                <li><a class="blue-theme" href="javascript:void(0)" data-skin="skin-blue">4</a></li>
                                <li><a class="purple-theme" href="javascript:void(0)" data-skin="skin-purple">5</a></li>
                                <li><a class="megna-theme" href="javascript:void(0)" data-skin="skin-megna">6</a></li>
                                <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                                <li><a class="default-dark-theme " href="javascript:void(0)" data-skin="skin-default-dark">7</a></li>
                                <li><a class="green-dark-theme" href="javascript:void(0)" data-skin="skin-green-dark">8</a></li>
                                <li><a class="red-dark-theme" href="javascript:void(0)" data-skin="skin-red-dark">9</a></li>
                                <li><a class="blue-dark-theme" href="javascript:void(0)" data-skin="skin-blue-dark">10</a></li>
                                <li><a class="purple-dark-theme" href="javascript:void(0)" data-skin="skin-purple-dark">11</a></li>
                                <li><a class="megna-dark-theme " href="javascript:void(0)" data-skin="skin-megna-dark">12</a></li>
                            </ul>
                            <ul class="m-t-20 chatonline">
                                <li><b>Chat option</b></li>
                                <li>
                                    <a href="javascript:void(0)"><img class="img-circle" alt="user-img" src="assets/images/users/1.jpg"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img class="img-circle" alt="user-img" src="assets/images/users/2.jpg"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img class="img-circle" alt="user-img" src="assets/images/users/3.jpg"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img class="img-circle" alt="user-img" src="assets/images/users/4.jpg"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img class="img-circle" alt="user-img" src="assets/images/users/5.jpg"> <span>Govinda Star <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img class="img-circle" alt="user-img" src="assets/images/users/6.jpg"> <span>John Abraham<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img class="img-circle" alt="user-img" src="assets/images/users/7.jpg"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img class="img-circle" alt="user-img" src="assets/images/users/8.jpg"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div tabindex="0" class="ps__scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; right: 0px;"><div tabindex="0" class="ps__scrollbar-y" style="top: 0px; height: 0px;"></div></div></div>
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
<?php include('footer.php');?>

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
                                                     <td><a href="single-produto.php">
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

<?php }  ?>