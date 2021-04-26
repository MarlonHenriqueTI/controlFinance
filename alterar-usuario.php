<?php include('header.php'); 

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $usuario = selecionarUnico($conexao, 'usuario', 'id', $id);
}

if(isset($_POST["nome"])){
    alterar($id, 'usuario', 'nome', $_POST["nome"], $conexao);


if(isset($_POST["email"])){
    alterar($id, 'usuario', 'email', $_POST["email"], $conexao);
}

echo '<script>alert("Sucesso");window.location.href="todos-usuarios.php";</script>';
}

if(isset($_POST["senha"])){
    $senha = $_POST["senha"];
    $confirma = $_POST["confirma"];
    if($senha == $confirma){
        $senha = md5($senha);
        alterar($id, 'usuario', 'senha', $senha, $conexao);
        echo '<script>alert("Sucesso");window.location.href="todos-usuarios.php";</script>';
    } else {
        echo '<script>alert("As senhas não coincidem...");</script>';
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
                        <h4 class="text-themecolor">Alterar Usuário</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                                <li class="breadcrumb-item active">Alterar Usuário</li>
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
                                <h4 class="m-b-0 text-white">Alterar um Usuário</h4>
                            </div>
                            <div class="card-body">
                                <form action="alterar-usuario.php?id=<?php echo $id; ?>" method="POST">
                                    <div class="form-body">
                                        <h3 class="card-title">Informações do usuário</h3>
                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Nome</label>
                                                    <input type="text" id="nome" class="form-control" placeholder="Nome do usuario" name="nome" required value="<?php echo $usuario[0]['nome']; ?>">
                                                </div>                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">E-mail</label>
                                                    <input type="email" id="email" class="form-control" placeholder="E-mail do usuario" name="email" value="<?php echo $usuario[0]['email']; ?>">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                             <div class="col">
                                                <div class="form-group">
                                                    <label class="control-label">Senha</label>
                                                    <input type="password" id="senha" class="form-control" placeholder="Digite a senha" name="senha">
                                                </div>                                            </div>
                                            <!--/span-->
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="control-label">Confirme a senha</label>
                                                    <input type="password" id="confirma" class="form-control" placeholder="Confirme sua senha" name="confirma">
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Alterar Usuário</button>
                                        <a type="button" href="index.php" class="btn btn-inverse" >Cancelar</a>
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