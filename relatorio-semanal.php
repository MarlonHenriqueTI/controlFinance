<?php include('header.php'); 


    $data_inicial = date('Y-m-d', strtotime('-7 days'));
    $data_final = date('Y-m-d');
    $vendas = selecionarTodosPeriodo($conexao, 'venda', $data_inicial, $data_final);
    $total_vendas = count($vendas);
    $valor_total = 0;
    foreach ($vendas as $key) {
        if($key["desconto_porcentagem"] != 0){
            $valor_total = $valor_total + ($key["valor_total"] - ($key["valor_total"]*($key["desconto_porcentagem"] / 100)));
        } else if($key["desconto_valor"] != 0){
            $valor_total = $valor_total + ($key["valor_total"] - $key["desconto_valor"]);
        } else {
            $valor_total = $valor_total + $key["valor_total"];
        }
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
                        <h4 class="text-themecolor">Relatório semanal</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                                <li class="breadcrumb-item active">Relatório semanal</li>
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
                                <h4 class="card-title">Relatório Geral Semanal</h4>
                                <h6 class="card-subtitle">periodo do dia <code><?php echo date('d/m/Y', strtotime($data_inicial)); ?> ao dia <?php echo date('d/m/Y', strtotime($data_final)); ?></code></h6>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h3><span style="color: orange;">Total de vendas:</span> <?php echo $total_vendas." vendas"; ?></h3>
                                    </div>
                                    <div class="col">
                                        <h3><span style="color: orange;">Valor Total Recebido:</span> <?php echo "R$".$valor_total; ?></h3>
                                    </div>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                   <table class="table color-bordered-table primary-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Cliente</th>
                                                <th>Produtos / Preço / Quantidade / Fornecedor </th>
                                                <th>Valor Total</th>
                                                <th>Desconto</th>
                                                <th>Meio de Pagamento</th>
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
                                                    <td>
                                                    <?php 
                                                        $venda = selecionarUnico($conexao, 'produtos_venda', 'id_venda', $key["id"]);
                                                        foreach ($venda as $varios) { 
                                                        $produto = selecionarUnico($conexao, 'produto', 'id', $varios["id_produto"]); 
                                                        $fornecedor = selecionarUnico($conexao, 'fornecedor', 'id', $produto[0]["id_fornecedor"]);
                                                    ?><?php echo $produto[0]["nome"]." / R$".$produto[0]["preco"]." / ".$varios["quantidade"]." unidades / ".$fornecedor[0]["nome"]; ?><br>
                                                    <?php } ?>
                                                    </td>
                                                    <?php if($key["desconto_porcentagem"] != 0){
                                                            $valortotal = $key["valor_total"] - ($key["valor_total"]*($key["desconto_porcentagem"] / 100));
                                                        } else if($key["desconto_valor"] != 0){
                                                            $valortotal = $key["valor_total"] - $key["desconto_valor"];
                                                        } else {
                                                            $valortotal = $key["valor_total"];
                                                        }

                                                     ?>
                                                    <td>R$<?php echo $valortotal; ?></td>
                                                    <td>
                                                        <?php if($key["desconto_porcentagem"] != 0){
                                                                echo $key["desconto_porcentagem"]."%";
                                                            } else if($key["desconto_valor"] != 0){
                                                                echo "R$".$key["desconto_valor"];
                                                            } else {
                                                                echo "Nenhum Desconto Aplicado";
                                                            } ?>
                                                    </td>
                                                    <td><?php echo $key["meio_pagamento"]; ?></td>
                                                    <td><?php echo $key["status"]; ?></td>
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

