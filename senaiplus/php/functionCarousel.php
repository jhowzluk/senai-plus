<?php

    function Carousel($search,$pesquisa){
        $carousel = "<div id='carouselExampleCaptions' class='carousel slide' data-bs-ride='carousel'>"
                    ."<div class='carousel-indicators '>"
                        ."<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='0' class='active' aria-current='true' aria-label='Slide 1'></button>"
                        ."<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='1' aria-label='Slide 2'></button>"
                        ."<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='2' aria-label='Slide 3'></button>"
                        ."<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='3' aria-label='Slide 4'></button>"
                        ."<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='4' aria-label='Slide 5'></button>"
                        ."<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='5' aria-label='Slide 6'></button>"
                        ."<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='6' aria-label='Slide 7'></button>"
                        ."<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='7' aria-label='Slide 8'></button>"
                        ."<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='8' aria-label='Slide 9'></button>"
                        ."<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='9' aria-label='Slide 10'></button>"
                    ."</div>"
                    ."<div class='carousel-inner '>";

        if($pesquisa == "Filmes" or $pesquisa == "Genero" or $pesquisa == 2){
            include('conexao.php');
            if($pesquisa == 2){
                $sql = "Select nome, carouselimage, idFilme, sinopse, hora, minuto, lancamento, classificacao_idClassificacao from filmes
                order by lancamento desc limit 5;";
                $count = 0;
            }else if($pesquisa == "Filmes"){
                $sql = "Select nome, carouselimage, idFilme, sinopse, hora, minuto, lancamento, classificacao_idClassificacao from filmes order by lancamento desc limit 10;"; 
                $count = 0;   
            }else if($pesquisa == "Genero"){
                $sql = "Select filmes.nome, filmes.carouselimage, filmes.idFilme, filmes.hora, filmes.minuto, filmes.lancamento, filmes.sinopse, filmes.classificacao_idClassificacao from filmes 
                        inner join generofilmes on filmes.idfilme = generofilmes.filmes_idFilme 
                        where generofilmes.generos_idGenero  = $search order by lancamento desc limit 5;";
                $count = 0; 
            }  

            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);

            if(mysqli_num_rows($result) > 0){
                $array = array();

                while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    array_push($array, $linha);
                }
                
                foreach($array as $campo){
                    $count = $count + 1;
                    
                    $avaliacao = avaliacao($campo['idFilme'], 'idFilme');
                    $linhaclassificacao = classificacao($campo['classificacao_idClassificacao']);
                    if($avaliacao >= 7){
                        if($count == 1){
                            $carousel .= "<div class='carousel-item active ' >"
                                            ."<img src='".$campo['carouselimage']."'  height='500px' b class='d-block w-100 carousel-image' alt='...'>"
                                            ."<div class='carousel-caption d-none d-md-block'>"
                                                ."<h5>".$campo['nome']."</h5>"
                                                .mb_strimwidth($campo['sinopse'], 0, 200, '...')."<br><br>"
                                                .$campo['hora']."h ".$campo['minuto']."min • ".mb_strimwidth($campo['lancamento'], 0, 4)." • "
                                                ."<div class='badge bg-green text-white '  style='gap: 100px;' ><b>&#9733 ".$avaliacao."</b></div><br><br>"
                                                ."<b>Classificação: </b>".$linhaclassificacao."<br><br>"
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                                    ."<button class='btn btn-outline-light' type='button'>"
                                                        ."<i class='bi-play me-1'></i>"
                                                        ."<b>Assistir</b>"
                                                    ."</button>"
                                                ."</a>"
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2'>"
                                                    ."<button class='btn btn-outline-light' type='button'>"
                                                        ."<i class='bi-plus me-1'></i>"
                                                    ."</button>"
                                                ."</a>"
                                            ."</div>"
                                        ."</div>";
                        }else{
                            $carousel .= "<div class='carousel-item' >"
                                            ."<img src='".$campo['carouselimage']."' height='500px' class='d-block w-100 carousel-image' alt='...'>"
                                            ."<div class='carousel-caption d-none d-md-block'>"
                                                ."<h5>".$campo['nome']."</h5>"
                                                .mb_strimwidth($campo['sinopse'], 0, 200, '...')."<br><br>"
                                                .$campo['hora']."h ".$campo['minuto']."min • ".mb_strimwidth($campo['lancamento'], 0, 4)." • "
                                                ."<div class='badge bg-green text-white '  style='gap: 100px;' ><b>&#9733 ".$avaliacao."</b></div><br><br>"
                                                ."<b>Classificação: </b>".$linhaclassificacao."<br><br>"
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                                    ."<button class='btn btn-outline-light' type='button'>"
                                                        ."<i class='bi-play me-1'></i>"
                                                        ."<b>Assistir</b>"
                                                    ."</button>"
                                                ."</a>"    
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2'>"
                                                    ."<button class='btn btn-outline-light' type='button'>"
                                                        ."<i class='bi-plus me-1'></i>"
                                                    ."</button>"
                                                ."</a>"
                                            ."</div>"
                                        ."</div>";
                        }
                    }
                    if($avaliacao >= 5 && $avaliacao < 7){
                        if($count == 1){
                            $carousel .= "<div class='carousel-item active ' >"
                                            ."<img src='".$campo['carouselimage']."'  height='500px' b class='d-block w-100 carousel-image' alt='...'>"
                                            .mb_strimwidth($campo['sinopse'], 0, 200, '...')."<br><br>"
                                                .$campo['hora']."h ".$campo['minuto']."min • ".mb_strimwidth($campo['lancamento'], 0, 4)." • "
                                                ."<div class='badge bg-yellow text-white '  style='gap: 100px;' ><b>&#9733 ".$avaliacao."</b></div><br><br>"
                                                ."<b>Classificação: </b>".$linhaclassificacao."<br><br>"
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                                    ."<button class='btn btn-outline-light' type='button' >"
                                                        ."<i class='bi-play me-1'></i>"
                                                        ."<b>Assistir</b>"
                                                    ."</button>"
                                                ."</a>"
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2'>"
                                                    ."<button class='btn btn-outline-light' type='button'>"
                                                        ."<i class='bi-plus me-1'></i>"
                                                    ."</button>"
                                                ."</a>"
                                        ."</div>";
                        }else{
                            $carousel .= "<div class='carousel-item' >"
                                            ."<img src='".$campo['carouselimage']."' height='500px' class='d-block w-100 carousel-image' alt='...'>"
                                            ."<div class='carousel-caption d-none d-md-block'>"
                                                ."<h5>".$campo['nome']."</h5>"
                                                .mb_strimwidth($campo['sinopse'], 0, 200, '...')."<br><br>"
                                                .$campo['hora']."h ".$campo['minuto']."min • ".mb_strimwidth($campo['lancamento'], 0, 4)." • "
                                                ."<div class='badge bg-yellow text-white '  style='gap: 100px;' ><b>&#9733 ".$avaliacao."</b></div><br><br>"
                                                ."<b>Classificação: </b>".$linhaclassificacao."<br><br>"
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                                    ."<button class='btn btn-outline-light' type='button'>"
                                                        ."<i class='bi-play me-1'></i>"
                                                        ."<b>Assistir</b>"
                                                    ."</button>"
                                                ."</a>"
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2'>"
                                                    ."<button class='btn btn-outline-light' type='button'>"
                                                        ."<i class='bi-plus me-1'></i>"
                                                    ."</button>"
                                                ."</a>"
                                            ."</div>"
                                        ."</div>";
                        }
                    }  
                    if($avaliacao < 5){
                        if($count == 1){
                            $carousel .= "<div class='carousel-item active ' >"
                                            ."<img src='".$campo['carouselimage']."'  height='500px' b class='d-block w-100 carousel-image' alt='...'>"
                                            ."<div class='carousel-caption d-none d-md-block'>"
                                                ."<h5>".$campo['nome']."</h5>"
                                                .mb_strimwidth($campo['sinopse'], 0, 200, '...')."<br><br>"
                                                .$campo['hora']."h ".$campo['minuto']."min • ".mb_strimwidth($campo['lancamento'], 0, 4)." • "
                                                ."<div class='badge bg-red text-white '  style='gap: 100px;' ><b>&#9733 ".$avaliacao."</b></div><br><br>"
                                                ."<b>Classificação: </b>".$linhaclassificacao."<br><br>"
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                                    ."<button class='btn btn-outline-light' type='button'>"
                                                        ."<i class='bi-play me-1'></i>"
                                                        ."<b>Assistir</b>"
                                                    ."</button>"
                                                ."</a>"
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2'>"
                                                    ."<button class='btn btn-outline-light' type='button'>"
                                                        ."<i class='bi-plus me-1'></i>"
                                                    ."</button>"
                                                ."</a>"
                                            ."</div>"
                                        ."</div>";
                        }else{
                            $carousel .= "<div class='carousel-item' >"
                                            ."<img src='".$campo['carouselimage']."' height='500px' class='d-block w-100 carousel-image' alt='...'>"
                                            ."<div class='carousel-caption d-none d-md-block'>"
                                                ."<h5>".$campo['nome']."</h5>"
                                                .mb_strimwidth($campo['sinopse'], 0, 200, '...')."<br><br>"
                                                .$campo['hora']."h ".$campo['minuto']."min • ".mb_strimwidth($campo['lancamento'], 0, 4)." • "
                                                ."<div class='badge bg-red text-white '  style='gap: 100px;' ><b>&#9733 ".$avaliacao."</b></div><br><br>"
                                                ."<b>Classificação: </b>".$linhaclassificacao."<br><br>"
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                                    ."<button class='btn btn-outline-light' type='button'>"
                                                        ."<i class='bi-play me-1'></i>"
                                                        ."<b>Assistir</b>"
                                                    ."</button>"
                                                ."</a>"
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2'>"
                                                    ."<button class='btn btn-outline-light' type='button'>"
                                                        ."<i class='bi-plus me-1'></i>"
                                                    ."</button>"
                                                ."</a>"
                                            ."</div>"
                                        ."</div>";
                        }
                    }                       
                }
                
            }
        }if($pesquisa == "Series" or $pesquisa == "Genero" or $pesquisa == 2){    
            include('conexao.php');
                if($pesquisa == 2){
                    $sql = "Select nome, carouselimage, idSerie, sinopse, lancamento, classificacao_idClassificacao from series
                            order by nome asc limit 5;";
                }else if($pesquisa == "Series"){
                    $sql = "Select nome, carouselimage, idSerie, sinopse, lancamento, classificacao_idClassificacao from Series order by nome asc limit 10;";
                    $count = 0;    
                }else if($pesquisa == "Genero"){
                    $sql = "Select series.nome, series.carouselimage, series.idSerie, series.sinopse, series.lancamento, series.classificacao_idClassificacao from series 
                    inner join generoseries on series.idserie = generoseries.series_idserie 
                    where generoseries.generos_idGenero  = $search order by nome asc limit 5;"; 
                }      

            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);

            if(mysqli_num_rows($result) > 0){
                $array = array();

                while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    array_push($array, $linha);
                }
                
                foreach($array as $campo){
                    $count = $count + 1;
                    $avaliacao = avaliacao($campo['idSerie'], 'idSerie');
                    $linhaclassificacao = classificacao($campo['classificacao_idClassificacao']);
                    if($avaliacao >= 7){
                        if($count == 1){
                            $carousel .= "<div class='carousel-item active ' >"
                                            ."<img src='".$campo['carouselimage']."'  height='500px' b class='d-block w-100 carousel-image' alt='...'>"
                                            ."<div class='carousel-caption d-none d-md-block'>"
                                                ."<h5>".$campo['nome']."</h5>"
                                                .mb_strimwidth($campo['sinopse'], 0, 200, '...')."<br><br>"
                                                .mb_strimwidth($campo['lancamento'], 0, 4)." • "
                                                ."<div class='badge bg-green text-white '  style='gap: 100px;' ><b>&#9733 ".$avaliacao."</b></div><br><br>"
                                                ."<b>Classificação: </b>".$linhaclassificacao."<br><br>"
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                                    ."<button class='btn btn-outline-light' type='button'>"
                                                        ."<i class='bi-play me-1'></i>"
                                                        ."<b>Assistir</b>"
                                                    ."</button>"
                                                ."</a>"
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2'>"
                                                    ."<button class='btn btn-outline-light' type='button'>"
                                                        ."<i class='bi-plus me-1'></i>"
                                                    ."</button>"
                                                ."</a>"
                                            ."</div>"
                                        ."</div>";
                        }else{
                            $carousel .= "<div class='carousel-item' >"
                                            ."<img src='".$campo['carouselimage']."' height='500px' class='d-block w-100 carousel-image' alt='...'>"
                                            ."<div class='carousel-caption d-none d-md-block'>"
                                                ."<h5>".$campo['nome']."</h5>"
                                                .mb_strimwidth($campo['sinopse'], 0, 200, '...')."<br><br>"
                                                .mb_strimwidth($campo['lancamento'], 0, 4)." • "
                                                ."<div class='badge bg-green text-white '  style='gap: 100px;' ><b>&#9733 ".$avaliacao."</b></div><br><br>"
                                                ."<b>Classificação: </b>".$linhaclassificacao."<br><br>"
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                                    ."<button class='btn btn-outline-light' type='button'>"
                                                        ."<i class='bi-play me-1'></i>"
                                                        ."<b>Assistir</b>"
                                                    ."</button>"
                                                ."</a>"
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2'>"
                                                    ."<button class='btn btn-outline-light' type='button'>"
                                                        ."<i class='bi-plus me-1'></i>"
                                                    ."</button>"
                                                ."</a>"
                                            ."</div>"
                                        ."</div>";
                        }
                    }
                    if($avaliacao >= 5 && $avaliacao < 7){
                        if($count == 1){
                            $carousel .= "<div class='carousel-item active ' >"
                                            ."<img src='".$campo['carouselimage']."'  height='500px' b class='d-block w-100 carousel-image' alt='...'>"
                                            ."<div class='carousel-caption d-none d-md-block'>"
                                                ."<h5>".$campo['nome']."</h5>"
                                                .mb_strimwidth($campo['sinopse'], 0, 200, '...')."<br><br>"
                                                .mb_strimwidth($campo['lancamento'], 0, 4)." • "
                                                ."<div class='badge bg-yellow text-white '  style='gap: 100px;' ><b>&#9733 ".$avaliacao."</b></div><br><br>"
                                                ."<b>Classificação: </b>".$linhaclassificacao."<br><br>"
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                                    ."<button class='btn btn-outline-light' type='button'>"
                                                        ."<i class='bi-play me-1'></i>"
                                                        ."<b>Assistir</b>"
                                                    ."</button>"
                                                ."</a>"
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2'>"
                                                    ."<button class='btn btn-outline-light' type='button'>"
                                                        ."<i class='bi-plus me-1'></i>"
                                                    ."</button>"
                                                ."</a>"
                                            ."</div>"
                                        ."</div>";
                        }else{
                            $carousel .= "<div class='carousel-item' >"
                                            ."<img src='".$campo['carouselimage']."' height='500px' class='d-block w-100 carousel-image' alt='...'>"
                                            ."<div class='carousel-caption d-none d-md-block'>"
                                                ."<h5>".$campo['nome']."</h5>"
                                                .mb_strimwidth($campo['sinopse'], 0, 200, '...')."<br><br>"
                                                .mb_strimwidth($campo['lancamento'], 0, 4)." • "
                                                ."<div class='badge bg-yellow text-white '  style='gap: 100px;' ><b>&#9733 ".$avaliacao."</b></div><br><br>"
                                                ."<b>Classificação: </b>".$linhaclassificacao."<br><br>"
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                                    ."<button class='btn btn-outline-light' type='button'>"
                                                        ."<i class='bi-play me-1'></i>"
                                                        ."<b>Assistir</b>"
                                                    ."</button>"
                                                ."</a>"
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2'>"
                                                    ."<button class='btn btn-outline-light' type='button'>"
                                                        ."<i class='bi-plus me-1'></i>"
                                                    ."</button>"
                                                ."</a>"
                                            ."</div>"
                                        ."</div>";
                        }
                    }  
                    if($avaliacao < 5){
                        if($count == 1){
                            $carousel .= "<div class='carousel-item active ' >"
                                            ."<img src='".$campo['carouselimage']."'  height='500px' b class='d-block w-100 carousel-image' alt='...'>"
                                            ."<div class='carousel-caption d-none d-md-block'>"
                                                ."<h5>".$campo['nome']."</h5>"
                                                .mb_strimwidth($campo['sinopse'], 0, 200, '...')."<br><br>"
                                                .mb_strimwidth($campo['lancamento'], 0, 4)." • "
                                                ."<div class='badge bg-red text-white '  style='gap: 100px;' ><b>&#9733 ".$avaliacao."</b></div><br><br>"
                                                ."<b>Classificação: </b>".$linhaclassificacao."<br><br>"
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                                    ."<button class='btn btn-outline-light' type='button'>"
                                                        ."<i class='bi-play me-1'></i>"
                                                        ."<b>Assistir</b>"
                                                    ."</button>"
                                                ."</a>"
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2'>"
                                                    ."<button class='btn btn-outline-light' type='button'>"
                                                        ."<i class='bi-plus me-1'></i>"
                                                    ."</button>"
                                                ."</a>"
                                            ."</div>"
                                        ."</div>";
                        }else{
                            $carousel .= "<div class='carousel-item' >"
                                            ."<img src='".$campo['carouselimage']."' height='500px' class='d-block w-100 carousel-image' alt='...'>"
                                            ."<div class='carousel-caption d-none d-md-block'>"
                                                ."<h5>".$campo['nome']."</h5>"
                                                .mb_strimwidth($campo['sinopse'], 0, 200, '...')."<br><br>"
                                                .mb_strimwidth($campo['lancamento'], 0, 4)." • "
                                                ."<div class='badge bg-red text-white '  style='gap: 100px;' ><b>&#9733 ".$avaliacao."</b></div><br><br>"
                                                ."<b>Classificação: </b>".$linhaclassificacao."<br><br>"
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                                    ."<button class='btn btn-outline-light' type='button'>"
                                                        ."<i class='bi-play me-1'></i>"
                                                        ."<b>Assistir</b>"
                                                    ."</button>"
                                                ."</a>"
                                                ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2'>"
                                                    ."<button class='btn btn-outline-light' type='button'>"
                                                        ."<i class='bi-plus me-1'></i>"
                                                    ."</button>"
                                                ."</a>"
                                            ."</div>"
                                        ."</div>";
                        }
                    }                              
                }
                
            }
        }    
        $carousel .= "<button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide='prev'>"
                        ."<span class='carousel-control-prev-icon' aria-hidden='true'></span>"
                        ."<span class='visually-hidden'>Previous</span>"
                    ."</button>"
                    ."<button class='carousel-control-next' type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide='next'>"
                        ."<span class='carousel-control-next-icon' aria-hidden='true'></span>"
                        ."<span class='visually-hidden'>Next</span>"
                    ."</button>"
                 ."</div>"
                 ."</div>";
        return $carousel;   
    }
