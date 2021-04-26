<?php include('header.php'); 

$produtos = selecionarTodos($conexao, "produto");

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
                        <h4 class="text-themecolor">Seu Estoque</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                                <li class="breadcrumb-item active">Seu Estoque</li>
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
                                <h4 class="card-title">Todos os produtos</h4>
                                <h6 class="card-subtitle">você pode alterar a quantidade <code>clicando na quantidade do produto</code></h6>
                                <div class="table-responsive">
                                    <table class="table color-bordered-table primary-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Produto</th>
                                                <th>Preço</th>
                                                <th>Quantidade disponivel</th>
                                                <th>Alterar/Excluir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php foreach ($produtos as $key) { ?>
                                                <tr>
                                                    <td><?php echo $key["id"]; ?></td>
                                                    <td><a href="single-produto.php?id=<?php echo $key['id']; ?>">
                                                        <?php if(!empty($key["foto"])){ ?>
                                                        <img src="assets/images/<?php echo $key['foto']; ?>" alt="user" class="img-circle" width="40"><?php } ?> <?php echo $key["nome"]; ?></a></td>
                                                    <td>R$<?php echo $key["preco"]; ?></td>
                                                    <td><a href="#"  data-toggle="modal" <?php  echo 'data-target="#alterar-unidades'.$key["id"].'"'; ?> ><?php echo $key["quantidade"]; ?> unidades</a></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button class="btn btn-success" type="button">Ação</button>
                                                            <button class="btn btn-success dropdown-toggle dropdown-toggle-split" aria-expanded="false" aria-haspopup="true" type="button" data-toggle="dropdown">
                                                                <span class="sr-only">Selecione o que deseja fazer</span>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="alterar-produto.php?id=<?php echo $key['id']; ?>">Alterar</a>
                                                                <a class="dropdown-item" href="#" onclick="deletar(<?php echo $key["id"]; ?>, 'produto')">Excluir</a>
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


 <?php foreach ($produtos as $key) { ?>
<!-- Modal Login -->
<div class="modal fade" <?php echo 'id="alterar-unidades'.$key['id'].'"'; ?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color: grey;">Alterar Estoque atual do produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="alterar-quantidade.php" method="POST">
          <div class="form-group">
           <label for="cod" style="color: grey;">Quantas unidades do produto você possui atualmente?</label>
           <input type="text" placeholder="qtd" name="qtd" class="form-control" required value="<?php  echo $key['quantidade']; ?>">
          </div>
      </div>
      <input type="text" name="id" style="display: none;" value="<?php  echo $key['id']; ?>">
      <div class="modal-footer">
        <a type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</a>
        <button type="submit" class="btn btn-primary">Alterar Estoque</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php   } ?>