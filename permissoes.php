<?php include('header.php'); 

$id = $_GET["id"];
$usuario = selecionarUnico($conexao, 'usuario', 'id', $id);
$permissoes = selecionarUnico($conexao, 'permissoes', 'id_usuario', $id);
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
                        <h4 class="text-themecolor">Alterar permissões de <?php echo $usuario[0]["nome"]; ?></h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                                <li class="breadcrumb-item active">Alterar permissões</li>
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
                                <?php if($usuario[0]["email"] == "admin@admin.com") {?>
                                <h3>Permissões de <?php echo $usuario[0]["nome"]; ?> <h3>
                                <h4 style="color: orange;">Você não pode alterar as permissões deste usuario pois este é o usuário Administrador</h4>
                                <hr>
                                <a href="todos-usuarios.php" class="btn btn-inverse">Voltar</a>
                                <?php } else { ?>
                                <h3>Permissões de <?php echo $usuario[0]["nome"]; ?> <h3>
                                <h4 style="color: orange;">Selecione os modulos que este usuário tem acesso</h4>
                                <hr>
                                <div class="container">
                                    <form action="alterar-permissoes.php" method="POST">
                                        <?php if($permissoes[0]["sistema_vendas"]){ ?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="sistema_vendas" checked="">
                                            <label class="form-check-label" for="exampleCheck1">Sistema de Vendas</label>
                                        </div>
                                        <?php }else{ ?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="sistema_vendas">
                                            <label class="form-check-label" for="exampleCheck1">Sistema de Vendas</label>
                                        </div>
                                        <?php } ?>
                                        <hr>
                                        <?php if($permissoes[0]["clientes"]){ ?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="clientes" checked="">
                                            <label class="form-check-label" for="exampleCheck1">Clientes</label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="clientes">
                                            <label class="form-check-label" for="exampleCheck1">Clientes</label>
                                        </div>
                                        <?php } ?>
                                        <hr>
                                        <?php if($permissoes[0]["estoque"]){ ?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="estoque" checked="">
                                            <label class="form-check-label" for="exampleCheck1">Estoque</label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="estoque">
                                            <label class="form-check-label" for="exampleCheck1">Estoque</label>
                                        </div>
                                        <?php } ?>
                                        <hr>
                                        <?php if($permissoes[0]["fornecedores"]){ ?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="fornecedores" checked="">
                                            <label class="form-check-label" for="exampleCheck1">Fornecedores</label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="fornecedores">
                                            <label class="form-check-label" for="exampleCheck1">Fornecedores</label>
                                        </div>
                                        <?php } ?>
                                        <hr>
                                        <?php if($permissoes[0]["email"]){ ?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="email" checked="">
                                            <label class="form-check-label" for="exampleCheck1">E-mail</label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="email">
                                            <label class="form-check-label" for="exampleCheck1">E-mail</label>
                                        </div>
                                        <?php } ?>
                                        <hr>
                                        <?php if($permissoes[0]["vendas"]){ ?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="vendas" checked="">
                                            <label class="form-check-label" for="exampleCheck1">Vendas</label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="vendas">
                                            <label class="form-check-label" for="exampleCheck1">Vendas</label>
                                        </div>
                                        <?php } ?>
                                        <hr>
                                        <?php if($permissoes[0]["relatorios"]){ ?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="relatorios" checked="">
                                            <label class="form-check-label" for="exampleCheck1">Relatórios</label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="relatorios">
                                            <label class="form-check-label" for="exampleCheck1">Relatórios</label>
                                        </div>
                                        <?php } ?>
                                        <hr>
                                        <?php if($permissoes[0]["notas_fiscais"]){ ?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="notas_fiscais" checked="">
                                            <label class="form-check-label" for="exampleCheck1">Notas Fiscais</label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="notas_fiscais">
                                            <label class="form-check-label" for="exampleCheck1">Notas Fiscais</label>
                                        </div>
                                        <?php } ?>
                                        <hr>
                                        <?php if($permissoes[0]["usuarios"]){ ?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="usuarios" checked="">
                                            <label class="form-check-label" for="exampleCheck1">Usuários</label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="usuarios">
                                            <label class="form-check-label" for="exampleCheck1">Usuários</label>
                                        </div>
                                        <?php } ?>
                                        <hr>
                                        <input type="text" name="id_usuario" value="<?php echo $id; ?>" style="display: none;">
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Alterar Permissões</button>
                                            <a href="todos-usuarios.php" class="btn btn-inverse">Voltar</a>
                                        </div>
                                    </form>
                                </div>
                            <?php } ?>
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