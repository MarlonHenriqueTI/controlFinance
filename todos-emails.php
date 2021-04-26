<?php include('header.php'); 

if(isset($_POST["inicio"])){
    $data_inicial = $_POST["inicio"];
    $data_final = $_POST["final"];
    $emails = selecionarTodosPeriodo($conexao, 'email', $data_inicial, $data_final);
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
                        <h4 class="text-themecolor">Todos os emails por período</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                                <li class="breadcrumb-item active">Todos os emails do período</li>
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
                                <h4 class="card-title">Selecione um período para ver os e-mail</h4>
                                <hr>
                                <form action="todos-emails.php" method="post">
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
                                            <button type="submit" class="btn btn-rounded btn-block btn-outline-primary">Buscar e-mails</button>
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
                                <h4 class="card-title">Todos os e-mails do período</h4>
                                <h6 class="card-subtitle">e-mails disparados do dia <code><?php echo date('d/m/Y', strtotime($data_inicial)); ?> ao dia <?php echo date('d/m/Y', strtotime($data_final)); ?></code></h6>
                                <div class="table-responsive">
                                    <table class="table color-bordered-table primary-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Destinatário</th>
                                                <th>Assunto</th>
                                                <th>Conteúdo do E-mail</th>
                                                <th>Data</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($emails as $key) { ?>
                                               <tr>
                                                    <td><?php echo $key["id"]; ?></td>
                                                    <td>
                                                        <?php echo $key["destinatario"]; ?>
                                                    </td>
                                                    <td><?php echo $key["assunto"]; ?></td>
                                                    <td><a href="#"  data-toggle="modal" <?php  echo 'data-target="#conteudo'.$key["id"].'"'; ?> >Clique para ver o conteúdo</a></td>
                                                    <td><?php echo date("d-m-Y", strtotime($key["data"])); ?></td>
                                                    <?php if($key["enviado"]){ ?>
                                                        <td style="color: green;">Enviado</td>
                                                    <?php } else { ?>
                                                        <td style="color: gray;">Pendente</td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
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

 <?php foreach ($emails as $key) { ?>

<!-- Modal Login -->
<div class="modal fade" <?php echo 'id="conteudo'.$key["id"].'"'; ?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color: grey;"><?php echo $key["assunto"]; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4><?php echo $key["mensagem"]; ?></h4>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</a>
      </div>
    </div>
  </div>
</div>

<?php } ?>