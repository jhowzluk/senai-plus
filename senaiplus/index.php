<?php
    include('php/function.php');
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Senai+</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="image/icons/s.png" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-senaiplus">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">SENAI+</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="#!">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Gêneros</a>
                            <?php echo listaGeneros(); ?>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Cadastrar</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="telaFilmes.php">Filmes</a></li>
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#cadastrarSerie">Séries</a></li>
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#cadastrarEpisodio">Episódios</a></li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Modal para cadastrar Series -->
                    <div class="modal fade" id="cadastrarSerie" tabindex="-1" aria-labelledby="" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Cadastrar Séries</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="php/salvaSerie.php">
                                        <div class="mb-3">
                                            <label for="nomeSerie" class="form-label">Nome</label>
                                            <input type="text" class="form-control" id="nomeSerie">
                                        </div>
                                        <div class="mb-3">
                                            <label for="capaSerie" class="form-label">Imagem da capa</label>
                                            <input class="form-control" type="file" id="capaSerie">
                                        </div>
                                        <div class="mb-3">
                                            <label for="capaSerie" class="form-label">Imagem do carousel</label>
                                            <input class="form-control" type="file" id="capaSerie">
                                        </div>
                                        <div class="mb-3">
                                            <label for="sinopseSerie" class="form-label">Sinopse</label>
                                            <textarea class="form-control" id="sinopseSerie" rows="3"></textarea>
                                        </div>    
                                        <div class="mb-3">
                                            <label for="lancamentoSerie" class="form-label">Data de lançamento</label>
                                            <input type="date" class="form-control" id="lancamentoSerie">          
                                        </div>
                                        <div class="mb-3">
                                            <label for="estudioSerie" class="form-label">Estúdio</label>
                                            <input type="text" class="form-control" id="estudioSerie">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Classificação indicativa</label>
                                            <?php echo listaClassificacao('s'); ?>
                                        </div> 
                                </div>
                                <div class="modal-footer">
                                    <span class="limparButton"><button type="reset" class="btn btn-secondary">Limpar</button></span>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para cadastrar Episódios -->
                    <div class="modal fade" id="cadastrarEpisodio" tabindex="-1" aria-labelledby="" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Cadastrar Episódios</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="php/salvaEpisodio.php">
                                        <div class="mb-3">
                                            <label for="nomeEpisodio" class="form-label">Nome</label>
                                            <input type="text" class="form-control" id="nomeEpisodio">
                                        </div>
                                        <div class="mb-3">
                                            <label for="numEpisodio" class="form-label">Número do episódio</label>
                                            <input class="form-control" type="number" min=1 id="numEpisodio">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Série</label>
                                            <?php echo listaSerie(); ?>
                                        </div> 
                                        <div class="mb-3">
                                            <label for="numEpisodio" class="form-label">Número da temporada</label>
                                            <input class="form-control" type="number" min=1 id="numEpisodio">
                                        </div>
                                        <div class="mb-3">
                                            <label for="capaEpisodio" class="form-label">Vídeo do episódio</label>
                                            <input class="form-control" type="file" id="capaEpisodio">
                                        </div>
                                        <div class="mb-3">
                                            <label for="sinopseEpisodio" class="form-label">Sinopse</label>
                                            <textarea class="form-control" id="sinopseEpisodio" rows="3"></textarea>
                                        </div>    
                                        <div class="mb-3">
                                            <label for="lancamentoEpisodio" class="form-label">Data de lançamento</label>
                                            <input type="date" class="form-control" id="lancamentoEpisodio">          
                                        </div>
                                        <div class="mb-3">
                                            <label for="tempoEpisodio" class="form-label">Duração</label>
                                            <input type="time" class="form-control" id="tempoEpisodio">
                                        </div>
                                        <div class="mb-3">
                                            <label for="diretorEpisodio" class="form-label">Diretor</label>
                                            <input type="text" class="form-control" id="diretorEpisodio">
                                        </div>
                                        <div class="mb-3">
                                            <label for="elencoEpisodio" class="form-label">Elenco</label>
                                            <textarea class="form-control" id="elencoEpisodio" rows="3"></textarea>
                                        </div> 
                                </div>
                                <div class="modal-footer">
                                    <span class="limparButton"><button type="reset" class="btn btn-secondary">Limpar</button></span>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <form class="d-flex">
                        <button class="btn btn-outline-light" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark ">
            <?php echo Carousel(); ?>
        </header>
        <!-- Section-->
        <section class="py-5 bg-black">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php echo listaCatalogo(); ?>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-senaiplus">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Senai+ 2023</p></div>
        </footer>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
