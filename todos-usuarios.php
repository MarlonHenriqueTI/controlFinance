<?php include('header.php'); 

$usuarios = selecionarTodos($conexao, 'usuario');

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
                        <h4 class="text-themecolor">Todos os Usuários</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                                <li class="breadcrumb-item active">Todos os Usuários</li>
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
                                <h4 class="card-title">Todos os Usuários</h4>
                                <h6 class="card-subtitle">Clique no nome para <code>alterar permissões</code></h6>
                                <div class="table-responsive">
                                    <table class="table color-bordered-table primary-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>Alterar/Excluir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($usuarios as $key) {?>
                                                <tr>
                                                    <td><?php echo $key["id"]; ?></td>
                                                    <td>
                                                        <a href="permissoes.php?id=<?php echo $key['id']; ?>"><?php echo $key["nome"]; ?></a>
                                                    </td>
                                                    <td><?php echo $key["email"]; ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button class="btn btn-success" type="button">Ação</button>
                                                            <button class="btn btn-success dropdown-toggle dropdown-toggle-split" aria-expanded="false" aria-haspopup="true" type="button" data-toggle="dropdown">
                                                                <span class="sr-only">Selecione o que deseja fazer</span>
                                                            </button>
                                                            <?php if($key["email"] == "admin@admin.com"){?>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:void(0)">Não é possível alterar ou excluir o administrador</a>
                                                               
                                                            </div>
                                                            <?php } else { ?>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="alterar-usuario.php?id=<?php echo $key['id']; ?>">Alterar</a>
                                                                <a class="dropdown-item" href="#" onclick="deletar(<?php echo $key["id"]; ?>, 'usuario')">Excluir</a>
                                                            </div>
                                                            <?php } ?>
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