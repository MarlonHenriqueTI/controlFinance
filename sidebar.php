        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php $permissoes = selecionarUnico($conexao, 'permissoes', 'id_usuario', $user['id']); ?>
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar ps ps--theme_default ps--active-y" data-ps-id="33650ad9-b165-6cf6-4eba-10ec607ed91c">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="user-pro"> <a class="has-arrow waves-effect waves-dark" aria-expanded="false" href="javascript:void(0)"><span class="hide-menu"><?php echo $user["nome"]; ?></span></a>
                            <ul class="collapse" aria-expanded="false">
                                <li><a href="alterar-usuario.php?id=<?php echo $user["id"]; ?>"><i class="ti-user"></i> Meu Perfil</a></li>
                                <li><a href="logout.php"><i class="fa fa-power-off"></i> Sair</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" aria-expanded="false" href="javascript:void(0)"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard </span></a>
                            <ul class="collapse" aria-expanded="false">
                                <li><a href="index.php">Inicio </a></li>
                                
                            </ul>
                        </li>
                        <?php if($permissoes[0]["sistema_vendas"]){ ?>
                        <li> <a class="has-arrow waves-effect waves-dark" aria-expanded="false" href="javascript:void(0)"><i class="ti-shopping-cart"></i><span class="hide-menu">Sistema de Vendas</span></a>
                            <ul class="collapse" aria-expanded="false">
                                <li><a href="cadastrar-venda.php">Cadastrar venda</a></li>
                                <li><a href="vendas-diarias.php">Todas as vendas (Hoje)</a></li>
                                <li><a href="todas-vendas-periodo.php">Todas as vendas (Por data)</a></li>
                            </ul>
                        </li>
                        <?php } ?>
                        <?php if($permissoes[0]["clientes"]){ ?>
                        <li> <a class="has-arrow waves-effect waves-dark" aria-expanded="false" href="javascript:void(0)"><i class="ti-user"></i><span class="hide-menu">Clientes</span></a>
                            <ul class="collapse" aria-expanded="false">
                                <li><a href="cadastrar-cliente.php">Cadastrar cliente</a></li>
                                <li><a href="todos-clientes.php">Todos os clientes</a></li>
                            </ul>
                        </li>
                        <?php } ?>
                        <?php if($permissoes[0]["estoque"]){ ?>
                        <li> <a class="has-arrow waves-effect waves-dark" aria-expanded="false" href="javascript:void(0)"><i class="ti-package"></i><span class="hide-menu">Estoque</span></a>
                            <ul class="collapse" aria-expanded="false">
                                <li><a href="cadastrar-produto.php">Cadastrar produto</a></li>
                                <li><a href="estoque.php">Ver estoque de produtos</a></li>
                            </ul>
                        </li>
                        <?php } ?>
                        <?php if($permissoes[0]["fornecedores"]){ ?>
                        <li> <a class="has-arrow waves-effect waves-dark" aria-expanded="false" href="javascript:void(0)"><i class="ti-truck"></i><span class="hide-menu">Fornecedores</span></a>
                            <ul class="collapse" aria-expanded="false">
                                <li><a href="cadastrar-fornecedor.php">Cadastrar fornecedor</a></li>
                                <li><a href="todos-fornecedores.php">Todos os fornecedores</a></li>
                                <li><a href="cadastrar-pedido.php">Lançar Pedido Para Fornecedor</a></li>
                                <li><a href="pedidos.php">Todos os Pedidos</a></li>
                            </ul>
                        </li>
                        <?php } ?>
                        <?php if($permissoes[0]["email"]){ ?>
                        <li> <a class="has-arrow waves-effect waves-dark" aria-expanded="false" href="javascript:void(0)"><i class="ti-email"></i><span class="hide-menu">E-mail</span></a>
                            <ul class="collapse" aria-expanded="false">
                                <li><a href="todos-emails.php">Saídas</a></li>
                                <li><a href="programar-email.php">Programar E-mail</a></li>
                            </ul>
                        </li>
                        <?php } ?>
                        <?php if($permissoes[0]["vendas"]){ ?>
                        <li> <a class="has-arrow waves-effect waves-dark" aria-expanded="false" href="javascript:void(0)"><i class="ti-money"></i><span class="hide-menu">Vendas</span></a>
                            <ul class="collapse" aria-expanded="false">
                                <li><a href="vendas-semanais.php">Semanais</a></li>
                                <li><a href="vendas-debito.php">Em debito</a></li>
                                <li><a href="todas-vendas.php">Todas as vendas</a></li>
                            </ul>
                        </li>
                        <?php } ?>
                        <?php if($permissoes[0]["relatorios"]){ ?>
                        <li> <a class="has-arrow waves-effect waves-dark" aria-expanded="false" href="javascript:void(0)"><i class="ti-archive"></i><span class="hide-menu">Relatórios</span></a>
                            <ul class="collapse" aria-expanded="false">
                                <li><a href="relatorio-semanal.php">Semanal</a></li>
                                <li><a href="relatorio-quinzenal.php">Quinzenal</a></li>
                                <li><a href="relatorio-periodo.php">Por Período</a></li>
                                <li><a href="relatório-fornecedor.php">Relatório por fornecedor</a></li>
                                
                            </ul>
                        </li>
                        <?php } ?>
                        <?php if($permissoes[0]["notas_fiscais"]){ ?>
                        <li> <a class="has-arrow waves-effect waves-dark" aria-expanded="false" href="javascript:void(0)"><i class="ti-notepad"></i><span class="hide-menu">Notas Fiscais</span></a>
                            <ul class="collapse" aria-expanded="false">
                                <li><a href="notas.php">Notas geradas</a></li>
                                <li><a href="gerar-nota.php">Gerar nota fiscal</a></li>
                                <li><a href="carta-correcao-nfe.php">Gerar carta de correção da NF-e</a></li>
                                
                            </ul>
                        </li>
                        <?php } ?>
                        <?php if($permissoes[0]["usuarios"]){ ?>
                        <li> <a class="has-arrow waves-effect waves-dark" aria-expanded="false" href="javascript:void(0)"><i class="ti-user"></i><span class="hide-menu">Usuários</span></a>
                            <ul class="collapse" aria-expanded="false">
                                <li><a href="cadastrar-usuario.php">Cadastrar novo</a></li>
                                <li><a href="todos-usuarios.php">Todos os usuários</a></li>
                            </ul>
                        </li>
                        <?php } ?>
                        <li> <a class="waves-effect waves-dark" aria-expanded="false" href="logout.php"><i class="fa fa-circle-o text-danger"></i><span class="hide-menu">Sair</span></a></li>
                        
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div tabindex="0" class="ps__scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; height: 517px; right: 0px;"><div tabindex="0" class="ps__scrollbar-y" style="top: 0px; height: 210px;"></div></div></div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->