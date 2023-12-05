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
                                    <h3 class="card-title text-orange"><b>Episódios</b></h3>
                                </div>
                                <div class="col-md-3" align="right">
                                    <a href="usuario" class="btn btn-success" data-toggle="modal" data-target="#cadastrarEpisodio" title="Inserir um novo usuário">
                                        <i class="fas fa-plus-circle"></i>
                                        <span>Novo Episódio</span>
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
                                    <th>Série</th>
                                    <th>N° Episódio</th>
                                    <th>N° Temporada</th>
                                    <th>Duração</th>
                                    <th>Lançamento</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php echo carregaEpisodios(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <!-- Modal para cadastrar Episodios -->
            <div class="modal fade" id="cadastrarEpisodio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h4 class="modal-title" id="exampleModalLabel">Cadastrar Episodio</h4>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="php/salvaEpisodio.php?id=0" enctype="multipart/form-data">
                            <div class="modal-body">
                            <div class="mb-3">
                                    <label for="iNomeEpisodio" class="form-label">Nome</label>
                                    <input type="text" class="form-control" name="nNomeEpisodio" id="iNomeEpisodio">
                                </div>
                                <div class="mb-3">
                                    <label for="iTemporadaEpisodio" class="form-label">N° Temporada</label>
                                    <input class="form-control" type="number" name="nTemporadaEpisodio" id="iTemporadaEpisodio">
                                </div>
                                <div class="mb-3">
                                    <label for="iNumeroEpisodio" class="form-label">N° Episódio</label>
                                    <input class="form-control" type="number" name="nNumeroEpisodio" id="iNumeroEpisodio">
                                </div>
                                <div class="mb-3">
                                    <label for="iVideoEpisodio" class="form-label">Vídeo do episódio</label>
                                    <input class="form-control" type="file" name="nVideoEpisodio" id="iVideoEpisodio" accept="video/*">
                                </div>
                                <div class="mb-3">
                                    <label for="iSinopseEpisodio" class="form-label">Sinopse</label>
                                    <textarea class="form-control" name="nSinopseEpisodio" id="iSinopseEpisodio" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="iLancamentoEpisodio" class="form-label">Data de lançamento</label>
                                    <input type="date" class="form-control" name="nLancamentoEpisodio" id="iLancamentoEpisodio">
                                </div>
                                <br>
                                <div class="mb-3">
                                    <label class="form-label">Série:&nbsp;&nbsp;</label>
                                    <?php echo listaSerie(); ?>
                                </div>
                                <br>
                                <div class="mb-3">
                                    <label for="iTempoEpisodio" class="form-label">Duração</label>
                                    <input type="time" class="form-control" name="nTempoEpisodio" id="iTempoEpisodio">
                                </div>
                                <div class="mb-3">
                                    <label for="iDiretorEpisodio" class="form-label">Diretor</label>
                                    <input type="text" class="form-control" name="nDiretorEpisodio" id="iDiretorEpisodio">
                                </div>
                                <div class="mb-3">
                                    <label for="iElencoEpisodio" class="form-label">Elenco</label>
                                    <textarea class="form-control" name="nElencoEpisodio" id="iElencoEpisodio" rows="3"></textarea>
                                </div> 
                            </div>
                    
                            <div class="modal-footer">
                                <a href="telaEpisodios.php" class="btn btn-danger" title="Cancelar a operação">
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