<?php include('header.php'); 

$clientes = selecionarTodos($conexao, "cliente");

if(isset($_POST["mensagem"])){
    $destinatario = $_POST["destinatario"];
    $mensagem = $_POST["mensagem"];
    $assunto = $_POST["assunto"];
    $data = $_POST["data"];
    cadastrarEmail($conexao, $destinatario, $mensagem, $assunto, $data);
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
                        <h4 class="text-themecolor">Programar E-mail</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                                <li class="breadcrumb-item active">Programar E-mail</li>
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-dark">
                                <h4 class="m-b-0 text-white">Enviar e-mail</h4>
                            </div>
                            <div class="card-body">
                                <form action="programar-email.php" method="POST">
                                    <div class="form-body">
                                        <h3 class="card-title">Programe o e-mail</h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Para quem você deseja enviar o e-mail?</label>
                                                    <select name="destinatario" class="form-control" required>
                                                        <option value="clientes">Todos os clientes</option>
                                                        <option value="usuarios">Todos os usuários</option>
                                                        <option value="todos">Todos, sem excessão</option>
                                                        <?php foreach ($clientes as $key) {?>
                                                            <option value="<?php echo $key['email']; ?>"><?php echo $key['nome']." | ".$key['email']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Assunto do E-mail</label>
                                                    <input type="text" class="form-control" name="assunto" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Programe a data</label>
                                                    <input type="date" class="form-control" name="data" required>
                                                    <small>Deixe em branco para enviar imediatamente</small>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Mensagem</label>
                                                    <textarea name="mensagem" id="mensagem" class="form-control" rows="20" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Programar Envio</button>
                                        <a href="index.php" class="btn btn-inverse">Cancelar</a>
                                    </div>
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