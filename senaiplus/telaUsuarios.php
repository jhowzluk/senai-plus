<?php
    include('php/function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senai+</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="image/icons/s.png" />
    <!-- Theme style -->
    <link rel="stylesheet" href="css/teste.min.css">
    <link rel="stylesheet" href="css/styleProf.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
</head>
<style>
    .container-fluid2 {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh; /* Isso garante que o contêiner ocupe pelo menos a altura total da janela */
    }

    .modal-body {
        max-height: calc(100vh - 200px); /* Ajuste a altura conforme necessário */
        overflow-y: auto;
    }
    
</style>
<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid2">
        
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-9">
                                    <h3 class="card-title text-orange"><b>Usuários</b></h3>
                                </div>
                                <div class="col-md-3" align="right">
                                    <a href="usuario" class="btn btn-success" data-toggle="modal" data-target="#cadastrarUsuario" title="Inserir um novo usuário">
                                        <i class="fas fa-plus-circle"></i>
                                        <span>Novo Usuario</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="iTabela" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>   
                                    <th>Sobrenome</th>
                                    <th>Telefone</th>
                                    <th>CPF</th>
                                    <th>Acesso</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php echo carregaUsuarios(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <!-- Modal para cadastrar Usuarios -->
            <div class="modal fade" id="cadastrarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h4 class="modal-title" id="exampleModalLabel">Cadastrar Usuario</h4>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="php/salvaUsuario.php?id=0" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="iNomeUsuario" class="form-label">Nome</label>
                                    <input type="text" class="form-control" name="nNomeUsuario" id="iNomeUsuario">
                                </div>
                                <div class="mb-3">
                                    <label for="iSobrenomeUsuario" class="form-label">Sobrenome do Usuário</label>
                                    <input class="form-control" type="text" name="nSobrenomeUsuario" id="iSobrenomeUsuario">
                                </div>
                                <div class="mb-3">
                                    <label for="iTelefone" class="form-label">Telefone</label>
                                    <input class="form-control" type="text" name="nTelefone" id="iTelefone">
                                </div>
                                <div class="mb-3">
                                    <label for="iCpfUsuario" class="form-label">CPF</label>
                                    <input class="form-control" type="text" maxlength="11" name="nCpfUsuario" id="iCpfUsuario">
                                </div>
                                <div class="mb-3">
                                    <label for="iEmailUsuario" class="form-label">E-mail</label>
                                    <input type="date" class="form-control" name="nEmailUsuario" id="iEmailUsuario">
                                </div>
                                <div class="mb-3">
                                    <label for="iSenhaUsuario" class="form-label">Senha</label>
                                    <input type="password" class="form-control" name="nAcessoUsuario" id="iSenhaUsuario">
                                </div>
                                <br>
                                <div class="mb-3">
                                    <label class="form-label">Acesso:&nbsp;&nbsp;</label>
                                    <?php echo listaAcesso(); ?>
                                </div>
                                <br>
                            </div>
                    
                            <div class="modal-footer">
                                <a href="telaUsuarios.php" class="btn btn-danger" title="Cancelar a operação">
                                    <span>Cancelar</span>
                                </a>
                                <input type="submit" class="btn btn-success" value="Salvar" title="Salvar alteração">
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div><!-- /.container-fluid -->
    </section>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>    
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <script src="plugins/chart.js/chart2.min.js"></script>
    <script>
    $(function () {
        $("#iTabela").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
    });
    </script>
</body>
</html>