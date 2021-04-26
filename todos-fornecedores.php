<?php include('header.php'); 

$fornecedores = selecionarTodos($conexao, "fornecedor");
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
                        <h4 class="text-themecolor">Todos os Fornecedores</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                                <li class="breadcrumb-item active">Todos os Fornecedores</li>
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
                                <h4 class="card-title">Todos os Fornecedores</h4>
                                
                                <div class="table-responsive">
                                    <table class="table color-bordered-table primary-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nome</th>
                                                <th>E-mail</th>
                                                <th>Telefone</th>
                                                <th>Documento</th>
                                                <th>Endereço</th>
                                                <th>Arquivo</th>
                                                <th>Alterar/Excluir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($fornecedores as $key) { ?>
                                                <tr>
                                                    <td><?php echo $key["id"]; ?></td>
                                                    <td><?php echo $key["nome"]; ?></td>
                                                    <td><?php echo $key["email"]; ?></td>
                                                    <td><?php echo $key["telefone"]; ?></td>
                                                    <td><?php echo $key["documento"]; ?></td>
                                                    <td><a href="#"  data-toggle="modal" <?php  echo 'data-target="#mostrar-endereco'.$key["id"].'"'; ?> >Clique para ver o endereço</a></td>
                                                    <td><a href="assets/arquivos/<?php echo $key['arquivo']; ?>" target="_blank"><?php echo $key["arquivo"]; ?></a></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button class="btn btn-success" type="button">Ação</button>
                                                            <button class="btn btn-success dropdown-toggle dropdown-toggle-split" aria-expanded="false" aria-haspopup="true" type="button" data-toggle="dropdown">
                                                                <span class="sr-only">Selecione o que deseja fazer</span>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="alterar-fornecedor.php?id=<?php echo $key['id']; ?>">Alterar</a>
                                                                <a class="dropdown-item" href="#" onclick="deletar(<?php echo $key["id"]; ?>, 'fornecedor')">Excluir</a>
                                                            </div>
                                                        </div>
                                                    </td>
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

<?php foreach ($fornecedores as $key) { ?>
<!-- Modal Login -->
<div class="modal fade" <?php echo 'id="mostrar-endereco'.$key["id"].'"'; ?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color: grey;">O endereço atual do fornecedor é:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4><?php echo $key["endereco"]; ?></h4>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</a>
      </div>
    </div>
  </div>
</div>
<?php } ?>