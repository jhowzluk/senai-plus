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
                                    <h3 class="card-title text-orange"><b>Séries</b></h3>
                                </div>
                                <div class="col-md-3" align="right">
                                    <a href="usuario" class="btn btn-success" data-toggle="modal" data-target="#cadastrarSerie" title="Inserir um novo usuário">
                                        <i class="fas fa-plus-circle"></i>
                                        <span>Nova Série</span>
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
                                    <th>Lançamento</th>
                                    <th>Estúdio</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php echo carregaSeries(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <!-- Modal para cadastrar Series -->
            <div class="modal fade" id="cadastrarSerie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h4 class="modal-title" id="exampleModalLabel">Cadastrar Série</h4>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="php/salvaSerie.php?id=0" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="iNomeSerie" class="form-label">Nome</label>
                                    <input type="text" class="form-control" name="nNomeSerie" id="iNomeSerie">
                                </div>
                                <div class="mb-3">
                                    <label for="iCapaSerie" class="form-label">Imagem da capa</label>
                                    <input class="form-control" type="file" name="nCapaSerie" id="iCapaSerie" accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label for="iCarouselSerie" class="form-label">Imagem do carousel</label>
                                    <input class="form-control" type="file" name="nCarouselSerie" id="iCarouselSerie" accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label for="iSinopseSerie" class="form-label">Sinopse</label>
                                    <textarea class="form-control" name="nSinopseSerie" id="iSinopseSerie" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="iLancamentoSerie" class="form-label">Data de lançamento</label>
                                    <input type="date" class="form-control" name="nLancamentoSerie" id="iLancamentoSerie">
                                </div>
                                <div class="mb-3">
                                    <label for="iEstudioSerie" class="form-label">Estúdio</label>
                                    <input type="text" class="form-control" name="nEstudioSerie" id="iEstudioSerie">
                                </div>
                                <br>
                                <div class="mb-3">
                                    <label class="form-label">Classificação indicativa:&nbsp;&nbsp;</label>
                                    <?php echo listaClassificacao('s'); ?>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <input type="checkbox" name="nGenero1" id="iGenero1">
                                            <label for="iGenero1" class="form-label">&nbsp;Ação</label>
                                        </div>
                                        <div class="mb-3">
                                            <input type="checkbox" name="nGenero2" id="iGenero2">
                                            <label for="iGenero2" class="form-label">&nbsp;Aventura</label>
                                        </div>
                                        <div class="mb-3">
                                            <input type="checkbox" name="nGenero3" id="iGenero3">
                                            <label for="iGenero3" class="form-label">&nbsp;Anime</label>
                                        </div>
                                        <div class="mb-3">
                                            <input type="checkbox" name="nGenero4" id="iGenero4">
                                            <label for="iGenero4" class="form-label">&nbsp;Comédia</label>
                                        </div>
                                        <div class="mb-3">
                                            <input type="checkbox" name="nGenero5" id="iGenero5">
                                            <label for="iGenero5" class="form-label">&nbsp;Documentário</label>
                                        </div>
                                        <div class="mb-3">
                                            <input type="checkbox" name="nGenero6" id="iGenero6">
                                            <label for="iGenero6" class="form-label">&nbsp;Drama</label>
                                        </div>
                                        <div class="mb-3">
                                            <input type="checkbox" name="nGenero7" id="iGenero7">
                                            <label for="iGenero7" class="form-label">&nbsp;Fantasia</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <input type="checkbox" name="nGenero8" id="iGenero8">
                                            <label for="iGenero8" class="form-label">&nbsp;Terror</label>
                                        </div>
                                        <div class="mb-3">
                                            <input type="checkbox" name="nGenero9" id="iGenero9">
                                            <label for="iGenero9" class="form-label">&nbsp;Infantil</label>
                                        </div>
                                        <div class="mb-3">
                                            <input type="checkbox" name="nGenero10" id="iGenero10">
                                            <label for="iGenero10" class="form-label">&nbsp;Suspense</label>
                                        </div>
                                        <div class="mb-3">
                                            <input type="checkbox" name="nGenero11" id="iGenero11">
                                            <label for="iGenero11" class="form-label">&nbsp;Mistério</label>
                                        </div>
                                        <div class="mb-3">
                                            <input type="checkbox" name="nGenero12" id="iGenero12">
                                            <label for="iGenero12" class="form-label">&nbsp;Romance</label>
                                        </div>
                                        <div class="mb-3">
                                            <input type="checkbox" name="nGenero13" id="iGenero13">
                                            <label for="iGenero13" class="form-label">&nbsp;Ficção Ciêntifica</label>
                                        </div>
                                    </div>
                                </div>     
                            </div>
                    
                            <div class="modal-footer">
                                <a href="telaSeries.php" class="btn btn-danger" title="Cancelar a operação">
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