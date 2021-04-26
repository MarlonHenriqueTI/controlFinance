<?php include('header.php'); 

if(isset($_POST["inicio"])){
    $data_inicial = $_POST["inicio"];
    $data_final = $_POST["final"];
    $notas = selecionarTodosPeriodo($conexao, 'nfe', $data_inicial, $data_final);
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
                        <h4 class="text-themecolor">Todas as notas por período</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                                <li class="breadcrumb-item active">Todas as notas do período</li>
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
                                <h4 class="card-title">Selecione um período para ver os dados</h4>
                                <hr>
                                <form action="notas.php" method="post">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Data Inicial</label>
                                                <input type="date" class="form-control" id="inicio" name="inicio" placeholder="Data Inicial">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Data Final</label>
                                                <input type="date" class="form-control" id="final" name="final" placeholder="Data Final">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col"></div>
                                        <div class="col-md-3 col-lg-3">
                                            <button type="submit" class="btn btn-rounded btn-block btn-outline-primary">Buscar notas</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php if(isset($_POST["inicio"])){ ?>

                        <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Todas as notas do período</h4>
                                <h6 class="card-subtitle">notas feitas do dia <code><?php echo date('d/m/Y', strtotime($data_inicial)); ?> ao dia <?php echo date('d/m/Y', strtotime($data_final)); ?></code></h6>
                                <div class="table-responsive">
                                    <table class="table color-bordered-table primary-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Arquivo</th>
                                                <th>Data</th>
                                                <th>uuid</th>
                                                <th>status</th>
                                                <th>numero</th>
                                                <th>serie</th>
                                                <th>chave</th>
                                                <th>xml</th>
                                                <th>danfe</th>
                                                <th>recibo</th>
                                                <th>Cancelar nota / Excluir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($notas as $key) { 
                                                if($key["numero"] != 0){
                                                ?>
                                                <tr>
                                                    <td><?php echo $key["id"]; ?></td>
                                                    <td><a href="<?php echo "assets/docs/".$key["arquivo"]; ?>" target="_blank"><?php echo "Ver Arquivo"; ?></a></td>
                                                    <td><?php echo date('d/m/Y', strtotime($key["data"])); ?></td>
                                                    <td><?php echo $key["uuid"]; ?></td>
                                                    <td><?php echo $key["status"]; ?></td>
                                                    <td><?php echo $key["numero"]; ?></td>
                                                    <td><?php echo $key["serie"]; ?></td>
                                                    <td><?php echo $key["chave"]; ?></td>
                                                    <td><a href="<?php echo $key["xml"]; ?>" target="_blank">Ver XML</a></td>
                                                    <td><a href="<?php echo $key["danfe"]; ?>" target="_blank">Ver Danfe</a></td>
                                                    <td><?php echo $key["recibo"]; ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button class="btn btn-success" type="button">Ação</button>
                                                            <button class="btn btn-success dropdown-toggle dropdown-toggle-split" aria-expanded="false" aria-haspopup="true" type="button" data-toggle="dropdown">
                                                                <span class="sr-only">Selecione o que deseja fazer</span>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="cancelar-nota.php?chave=<?php echo $key['chave']; ?>&id=<?php echo $key['id']; ?>">Cancelar Nf-e</a>
                                                                <a class="dropdown-item" href="#" onclick="deletar(<?php echo $key["id"]; ?>, 'nfe')">Excluir nf-e do sistema</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php } ?>
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