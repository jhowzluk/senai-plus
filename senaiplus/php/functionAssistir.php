<?php

    function telaAssistir(){
        if($_GET['tipo'] == 'filme'){
            
            include('conexao.php');
            $sql = "Select * from filmes where idFilme = ".$_GET['id'].";";

            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);

            if(mysqli_num_rows($result) > 0){
                $array = array();

                while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    array_push($array, $linha);
                }
                
                foreach($array as $campo){
                    $elenco = explode(',', $campo['elenco']);
                    $quantElenco = count($elenco);
                    $avaliacao = avaliacao($campo['idFilme'], 'idFilme');
                    $linhaclassificacao = classificacao($campo['classificacao_idClassificacao']);
                    if($avaliacao >= 7){

                        $assistir = "<img src='".$campo['carouselimage']."'  height='600px' b class='d-block w-100 carousel-image' alt='...'>"
                                    ."<div class='assistir-texto d-none d-md-block' height='600px'>"
                                        ."<h5>".$campo['nome']."</h5>"
                                        .$campo['sinopse']."<br><br>"
                                        .$campo['hora']."h ".$campo['minuto']."min • ".mb_strimwidth($campo['lancamento'], 0, 4)." • "
                                        ."<div class='badge bg-green text-white '  style='gap: 100px;' ><b>&#9733 ".$avaliacao."</b></div><br><br>"
                                        ."<b>Classificação: </b>".$linhaclassificacao."<br><br>"
                                        ."<b>Elenco: </b>";
                                        for ($i = 0; $i < $quantElenco; $i++){
                                            $assistir .= "<a href = 'http://google.com/search?q=".$elenco[$i]."' target='_blank' style='color: white;'>".$elenco[$i].", </a>";
                                        }
                                        $assistir .= "<br>"
                                        ."<b>Diretor: </b><a href = 'http://google.com/search?q=".$campo['diretor']."' target='_blank' style='color: white;'>".$campo['diretor']."</a><br>"
                                        ."<b>Estudio: </b><a href = 'http://google.com/search?q=".$campo['estudio']."' target='_blank' style='color: white;'>".$campo['estudio']."</a><br><br>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light' type='button' title='Assistir'>"
                                                ."<i class='bi-play me-1'></i>"
                                                ."<b>Assistir</b>"
                                            ."</button>"
                                        ."</a>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light' type='button' title='Minha lista'>"
                                                ."<i class=' me-1'></i>"
                                                ."<b>&plus;</b>"
                                            ."</button>"
                                        ."</a>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light' type='button'>"
                                                ."<i class=' me-1'></i>"
                                                ."<b>&#x1F44D;</b>"
                                            ."</button>"
                                        ."</a>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light'  type='button'>"
                                                ."<i class=' me-1'></i>"
                                                ."<b>&#x1F44E;</b>"
                                            ."</button>"
                                        ."</a>"
                                    ."</div>";
                    }
                    if($avaliacao >= 5 && $avaliacao < 7){

                        $assistir =  "<img src='".$campo['carouselimage']."'  height='600px' b class='d-block w-100 carousel-image' alt='...'>"
                                    ."<div class='assistir-texto d-none d-md-block' height='600px'>"
                                        ."<h5>".$campo['nome']."</h5>"
                                        .$campo['sinopse']."<br><br>"
                                        .$campo['hora']."h ".$campo['minuto']."min • ".mb_strimwidth($campo['lancamento'], 0, 4)." • "
                                        ."<div class='badge bg-yeloow text-white '  style='gap: 100px;' ><b>&#9733 ".$avaliacao."</b></div><br><br>"
                                        ."<b>Classificação: </b>".$linhaclassificacao."<br><br>"
                                        ."<b>Elenco: </b>";
                                        for ($i = 0; $i < $quantElenco; $i++){
                                            $assistir .= "<a href = 'http://google.com/search?q=".$elenco[$i]."' target='_blank' style='color: white;'>".$elenco[$i].", </a>";
                                        }
                                        $assistir .= "<br>"
                                        ."<b>Diretor: </b><a href = 'http://google.com/search?q=".$campo['diretor']."' target='_blank' style='color: white;'>".$campo['diretor']."</a><br>"
                                        ."<b>Estudio: </b><a href = 'http://google.com/search?q=".$campo['estudio']."' target='_blank' style='color: white;'>".$campo['estudio']."</a><br><br>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light' type='button' title='Assistir'>"
                                                ."<i class='bi-play me-1'></i>"
                                                ."<b>Assistir</b>"
                                            ."</button>"
                                        ."</a>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light' type='button' title='Minha lista'>"
                                                ."<i class=' me-1'></i>"
                                                ."<b>&plus;</b>"
                                            ."</button>"
                                        ."</a>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light' type='button'>"
                                                ."<i class=' me-1'></i>"
                                                ."<b>&#x1F44D;</b>"
                                            ."</button>"
                                        ."</a>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light'  type='button'>"
                                                ."<i class=' me-1'></i>"
                                                ."<b>&#x1F44E;</b>"
                                            ."</button>"
                                        ."</a>"
                                    ."</div>";
                    }  
                    if($avaliacao < 5){

                        $assistir =  "<img src='".$campo['carouselimage']."'  height='600px' b class='d-block w-100 carousel-image' alt='...'>"
                                    ."<div class='assistir-texto d-none d-md-block' height='600px'>"
                                        ."<h5>".$campo['nome']."</h5>"
                                        .$campo['sinopse']."<br><br>"
                                        .$campo['hora']."h ".$campo['minuto']."min • ".mb_strimwidth($campo['lancamento'], 0, 4)." • "
                                        ."<div class='badge bg-red text-white '  style='gap: 100px;' ><b>&#9733 ".$avaliacao."</b></div><br><br>"
                                        ."<b>Classificação: </b>".$linhaclassificacao."<br><br>"
                                        ."<b>Elenco: </b>";
                                        for ($i = 0; $i < $quantElenco; $i++){
                                            $assistir .= "<a href = 'http://google.com/search?q=".$elenco[$i]."' target='_blank' style='color: white;'>".$elenco[$i].", </a>";
                                        }
                                        $assistir .= "<br>"
                                        ."<b>Diretor: </b><a href = 'http://google.com/search?q=".$campo['diretor']."' target='_blank' style='color: white;'>".$campo['diretor']."</a><br>"
                                        ."<b>Estudio: </b><a href = 'http://google.com/search?q=".$campo['estudio']."' target='_blank' style='color: white;'>".$campo['estudio']."</a><br><br>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light' type='button' title='Assistir'>"
                                                ."<i class='bi-play me-1'></i>"
                                                ."<b>Assistir</b>"
                                            ."</button>"
                                        ."</a>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light' type='button' title='Minha lista'>"
                                                ."<i class=' me-1'></i>"
                                                ."<b>&plus;</b>"
                                            ."</button>"
                                        ."</a>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light' type='button'>"
                                                ."<i class=' me-1'></i>"
                                                ."<b>&#x1F44D;</b>"
                                            ."</button>"
                                        ."</a>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light'  type='button'>"
                                                ."<i class=' me-1'></i>"
                                                ."<b>&#x1F44E;</b>"
                                            ."</button>"
                                        ."</a>"
                                    ."</div>";
                    }                       
                }
                
            }
        }if($_GET['tipo'] == 'serie'){
            include('conexao.php');
            $sql = "Select * from series where idSerie = ".$_GET['id'].";";
            
            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);

            if(mysqli_num_rows($result) > 0){
                $array = array();

                while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    array_push($array, $linha);
                }
                
                foreach($array as $campo){
                    $avaliacao = avaliacao($campo['idSerie'], 'idSerie');
                    $linhaclassificacao = classificacao($campo['classificacao_idClassificacao']);
                    if($avaliacao >= 7){

                        $assistir = "<img src='".$campo['carouselimage']."'  height='600px' b class='d-block w-100 carousel-image' alt='...'>"
                                    ."<div class='assistir-texto d-none d-md-block' height='600px'>"
                                        ."<h5>".$campo['nome']."</h5>"
                                        .$campo['sinopse']."<br><br>"
                                        .mb_strimwidth($campo['lancamento'], 0, 4)." • "
                                        ."<div class='badge bg-green text-white '  style='gap: 100px;' ><b>&#9733 ".$avaliacao."</b></div><br><br>"                                        ."<b>Classificação: </b>".$linhaclassificacao."<br><br>"                
                                        ."<b>Estudio: </b><a href = 'http://google.com/search?q=".$campo['estudio']."' target='_blank' style='color: white;'>".$campo['estudio']."</a><br><br>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light' type='button' title='Assistir ep: 01'>"
                                                ."<i class='bi-play me-1'></i>1"
                                                ."<b>Assistir</b>"
                                            ."</button>"
                                        ."</a>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light' type='button' title='Minha lista'>"
                                                ."<i class=' me-1'></i>"
                                                ."<b>&plus;</b>"
                                            ."</button>"
                                        ."</a>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light' type='button'>"
                                                ."<i class=' me-1'></i>"
                                                ."<b>&#x1F44D;</b>"
                                            ."</button>"
                                        ."</a>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light'  type='button'>"
                                                ."<i class=' me-1'></i>"
                                                ."<b>&#x1F44E;</b>"
                                            ."</button>"
                                        ."</a>"
                                    ."</div>";
                    }
                    if($avaliacao >= 5 && $avaliacao < 7){

                        $assistir =  "<img src='".$campo['carouselimage']."'  height='600px' b class='d-block w-100 carousel-image' alt='...'>"
                                    ."<div class='assistir-texto d-none d-md-block' height='600px'>"
                                        ."<h5>".$campo['nome']."</h5>"
                                        .$campo['sinopse']."<br><br>"
                                        .mb_strimwidth($campo['lancamento'], 0, 4)." • "
                                        ."<div class='badge bg-green text-white '  style='gap: 100px;' ><b>&#9733 ".$avaliacao."</b></div><br><br>"                                        ."<b>Classificação: </b>".$linhaclassificacao."<br><br>"                
                                        ."<b>Estudio: </b><a href = 'http://google.com/search?q=".$campo['estudio']."' target='_blank' style='color: white;'>".$campo['estudio']."</a><br><br>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light' type='button' title='Assistir ep: 01'>"
                                                ."<i class='bi-play me-1'></i>1"
                                                ."<b>Assistir</b>"
                                            ."</button>"
                                        ."</a>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light' type='button' title='Minha lista'>"
                                                ."<i class=' me-1'></i>"
                                                ."<b>&plus;</b>"
                                            ."</button>"
                                        ."</a>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light' type='button'>"
                                                ."<i class=' me-1'></i>"
                                                ."<b>&#x1F44D;</b>"
                                            ."</button>"
                                        ."</a>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light'  type='button'>"
                                                ."<i class=' me-1'></i>"
                                                ."<b>&#x1F44E;</b>"
                                            ."</button>"
                                        ."</a>"
                                    ."</div>";
                    }  
                    if($avaliacao < 5){

                        $assistir =  "<img src='".$campo['carouselimage']."'  height='600px' b class='d-block w-100 carousel-image' alt='...'>"
                                    ."<div class='assistir-texto d-none d-md-block' height='600px'>"
                                        ."<h5>".$campo['nome']."</h5>"
                                        .$campo['sinopse']."<br><br>"
                                        .mb_strimwidth($campo['lancamento'], 0, 4)." • "
                                        ."<div class='badge bg-green text-white '  style='gap: 100px;' ><b>&#9733 ".$avaliacao."</b></div><br><br>"                                        ."<b>Classificação: </b>".$linhaclassificacao."<br><br>"                
                                        ."<b>Estudio: </b><a href = 'http://google.com/search?q=".$campo['estudio']."' target='_blank' style='color: white;'>".$campo['estudio']."</a><br><br>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light' type='button' title='Assistir ep: 01'>"
                                                ."<i class='bi-play me-1'></i>1"
                                                ."<b>Assistir</b>"
                                            ."</button>"
                                        ."</a>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light' type='button' title='Minha lista'>"
                                                ."<i class=' me-1'></i>"
                                                ."<b>&plus;</b>"
                                            ."</button>"
                                        ."</a>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light' type='button'>"
                                                ."<i class=' me-1'></i>"
                                                ."<b>&#x1F44D;</b>"
                                            ."</button>"
                                        ."</a>"
                                        ."<a href = 'http://localhost/senaiplus/index.php?s=&p=2' style='margin-right: 14px;'>"
                                            ."<button class='btn btn-outline-light'  type='button'>"
                                                ."<i class=' me-1'></i>"
                                                ."<b>&#x1F44E;</b>"
                                            ."</button>"
                                        ."</a>"
                                    ."</div>";
                     }                       
                }
            
             }
        }
        return($assistir);
    }