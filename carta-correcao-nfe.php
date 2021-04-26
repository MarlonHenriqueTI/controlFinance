<?php include('header.php'); 

$notas = selecionarTodos($conexao, 'nfe');

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
                <h4 class="text-themecolor">Gerar Carta de Correção da Nota Fiscal Eletronica</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                        <li class="breadcrumb-item active">Gerar Carta de Correção da  Nota Fiscal</li>
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
                        <form action="gerar-carta.php" method="POST" enctype="multipart/form-data">
                          <div class="row">
                            <div class="col-12">
                              <div class="form-group">
                                      <label>Selecione a nota</label>
                                      <select name="chave" class="js-example-basic-single form-control">
                                        <option value="">Selecione a nota</option>
                                        <?php foreach ($notas as $key) {?>
                                            <option value=" <?php echo $key['chave']; ?> "><?php echo "NF-e numero: ".$key['numero']; ?></option>
                                        <?php } ?>
                                       </select>
                                  </div> 
                            </div>
                            <div class="col-12">
                              <div class="form-group">
                                      <label>Digite a correção</label>
                                      <textarea name="correcao" id=""rows="10" class="form-control">O CFOP correto é 5.102 referente a revenda tributada no mesmo estado.</textarea>
                                  </div> 
                            </div>
                          </div>
                        
                           <button type="submit" class="btn btn-success">Salvar e enviar correção</button>
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