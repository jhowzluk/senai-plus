<?php

    
    function listaCatalogo($search,$pesquisa){
        $lista= "<div class='row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center'>";
        $naoEncontrado = 0;
       
        // Pesquisa Filmes
        if($pesquisa == 1 or $pesquisa == "Filmes" or $pesquisa == "Genero" or $pesquisa == 2){
            include('conexao.php');
            if($pesquisa == 1){
                $sql = "Select nome, capa, idFilme from filmes
                where nome like '%".$search."%' order by nome asc;";
            }else if($pesquisa == 2){
                $sql = "Select nome, capa, idFilme from filmes
                        order by nome asc;";
            }else if($pesquisa == "Filmes"){
                $sql = "Select nome, capa, idFilme from filmes order by nome asc;";    
            }else if($pesquisa == "Genero"){
                $sql = "Select filmes.nome, filmes.capa, filmes.idFilme from filmes 
                inner join generofilmes on filmes.idfilme = generofilmes.filmes_idFilme 
                where generofilmes.generos_idGenero  = $search order by nome asc;"; 
            }    
                
            
            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);

            if(mysqli_num_rows($result) > 0){
                $array = array();

                while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    array_push($array, $linha);
                }
                
                foreach($array as $campo){
                    $avaliacao = avaliacao($campo['idFilme'], 'idFilme');

                    if($avaliacao >= 7){
                        $lista .= "<a href = 'http://localhost/senaiplus/assistir.php?id=".$campo['idFilme']."&tipo=filme'><div class='col mb-3 heightcard' >"
                                    ."<div class='card h-100'>"
                                        ."<!-- nome badge-->"
                                        ."<div class='badge bg-dark text-white position-absolute' style='top: 0.5rem; right: 0.5rem'>".mb_strimwidth($campo['nome'], 0, 30, "...")."</div>"
                                        ."<!-- filme capa image-->"
                                        ."<img class='card-img'  src='".$campo['capa']."' alt='...' />"
                                        ."<!-- Product details-->"
                                        ."<div class='badge bg-green text-white position-absolute' style='bottom: 0.5rem; left: 0.5rem'><b>&#9733 ".$avaliacao."</b></div>"              
                                        ."</div>"
                                    ."</div></a>";
                    }if($avaliacao >= 5 && $avaliacao < 7){
                        $lista .= "<a href = 'http://localhost/senaiplus/assistir.php?id=".$campo['idFilme']."&tipo=filme'><div class='col mb-3 heightcard' >"
                                    ."<div class='card h-100'>"
                                        ."<!-- nome badge-->"
                                        ."<div class='badge bg-dark text-white position-absolute' style='top: 0.5rem; right: 0.5rem'>".mb_strimwidth($campo['nome'], 0, 30, "...")."</div>"
                                        ."<!-- filme capa image-->"
                                        ."<img class='card-img'  src='".$campo['capa']."' alt='...' />"
                                        ."<!-- Product details-->"
                                        ."<div class='badge bg-orange text-white position-absolute' style='bottom: 0.5rem; left: 0.5rem'><b>&#9733 ".$avaliacao."</b></div>"              
                                        ."</div>"
                                    ."</div></a>";
                    }if($avaliacao < 5){
                        $lista .= "<a href = 'http://localhost/senaiplus/assistir.php?id=".$campo['idFilme']."&tipo=filme'><div class='col mb-3 heightcard' >"
                                    ."<div class='card h-100'>"
                                        ."<!-- nome badge-->"
                                        ."<div class='badge bg-dark text-white position-absolute' style='top: 0.5rem; right: 0.5rem'>".mb_strimwidth($campo['nome'], 0, 30, "...")."</div>"
                                        ."<!-- filme capa image-->"
                                        ."<img class='card-img'  src='".$campo['capa']."' alt='...' />"
                                        ."<!-- Product details-->"
                                        ."<div class='badge bg-red text-white position-absolute' style='bottom: 0.5rem; left: 0.5rem'><b>&#9733 ".$avaliacao."</b></div>"              
                                        ."</div>"
                                    ."</div></a>";
                    }
                                                  
                }
                
            }else{
                if($search == ""){
                    $naoEncontrado = 0;
                }else{
                    $naoEncontrado = 1;
                }
                
            }

        }if($pesquisa == 1 or $pesquisa == "Series" or $pesquisa == "Genero" or $pesquisa == 2){
            // Pesquisa series
            include('conexao.php');
            if($pesquisa == 1){
                $sql = "Select nome, capa, idSerie from series
                        where nome like '%".$search."%' order by nome asc;";
            }else if($pesquisa == 2){
                $sql = "Select nome, capa, idSerie from series
                        order by nome asc;";
            }else if($pesquisa == "Series"){
                $sql = "Select nome, capa, idSerie from Series order by nome asc;";    
            }else if($pesquisa == "Genero"){
                $sql = "Select series.nome, series.capa, series.idSerie from series 
                inner join generoseries on series.idserie = generoseries.series_idserie 
                where generoseries.generos_idGenero  = $search order by nome asc;"; 
            }    
                
            
            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);

            if(mysqli_num_rows($result) > 0){
                $array = array();
                $naoEncontrado = 0;

                while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    array_push($array, $linha);
                }
                
                foreach($array as $campo){
                    $avaliacao = avaliacao($campo['idSerie'], 'idSerie');
                    if($avaliacao >= 7){
                        $lista .= "<a href = 'http://localhost/senaiplus/assistir.php?id=".$campo['idSerie']."&tipo=serie'><div class='col mb-3 heightcard'>"
                                    ."<div class='card h-100'>"
                                        ."<!-- nome badge-->"
                                        ."<div class='badge bg-dark text-white position-absolute' style='top: 0.5rem; right: 0.5rem'>".mb_strimwidth($campo['nome'], 0, 30, "...")."</div>"
                                        ."<!-- filme capa image-->"
                                        ."<img class='card-img'  src='".$campo['capa']."' alt='...' />"
                                        ."<!-- Product details-->"
                                        ."<div class='badge bg-green text-white position-absolute' style='bottom: 0.5rem; left: 0.5rem'><b>&#9733 ".$avaliacao."</b></div>"          
                                    ."</div>"
                                  ."</div></a>"; 
                    }
                    if($avaliacao >= 5 && $avaliacao < 7){
                        $lista .= "<a href = 'http://localhost/senaiplus/assistir.php?id=".$campo['idSerie']."&tipo=serie'><div class='col mb-3 heightcard' >"
                                ."<div class='card h-100'>"
                                    ."<!-- nome badge-->"
                                    ."<div class='badge bg-dark text-white position-absolute' style='top: 0.5rem; right: 0.5rem'>".mb_strimwidth($campo['nome'], 0, 30, "...")."</div>"
                                    ."<!-- filme capa image-->"
                                    ."<img class='card-img'  src='".$campo['capa']."' alt='...' />"
                                    ."<!-- Product details-->"
                                    ."<div class='badge bg-orange text-white position-absolute' style='bottom: 0.5rem; left: 0.5rem'><b>&#9733 ".$avaliacao."</b></div>"          
                                    ."</div>"
                                ."</div></a>"; 
                    }
                    if($avaliacao < 5){
                       $lista .= "<a href = 'http://localhost/senaiplus/assistir.php?id=".$campo['idSerie']."&tipo=serie'><div class='col mb-3 heightcard' >"
                                ."<div class='card h-100'>"
                                    ."<!-- nome badge-->"
                                    ."<div class='badge bg-dark text-white position-absolute' style='top: 0.5rem; right: 0.5rem'>".mb_strimwidth($campo['nome'], 0, 30, "...")."</div>"
                                    ."<!-- filme capa image-->"
                                    ."<img class='card-img'  src='".$campo['capa']."' alt='...' />"
                                    ."<!-- Product details-->"
                                    ."<div class='badge bg-red text-white position-absolute' style='bottom: 0.5rem; left: 0.5rem'><b>&#9733 ".$avaliacao."</b></div>"          
                                    ."</div>"
                                ."</div></a>";  
                    }
                                 
                }
        }
        if($naoEncontrado == 1){
            $lista = "<div class='row1 gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center' >"
                        ."<div class='col mb-3 heightcard' style=''>"
                            ."<div class='' style='background-color: #141619 !important; width: 650px; ' "
                                ."<!-- nome badge-->"
                                ."<div><h1 style='color: white; opacity: 0.7;'>Nenhum resultado encontrado para '".$search."' </h1></div>"          
                            ."</div>"
                        ."</div>";  
        }       
        }
        $lista .= "</div>";
        return $lista;
         
    }

    function semelhantesFilmes($id,$tipo){
        $lista = "<div class='row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center'>";
        if($tipo == 'filme'){
            
            include('conexao.php');
            $genero = "Select * from generofilmes 
                        where filmes_idFilme  = $id;";

            $result = mysqli_query($conn, $genero);
            mysqli_close($conn);

            if(mysqli_num_rows($result) > 0){
                $array = array();

                while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    array_push($array, $linha);
                }
                $jaMostrado = '';
                foreach($array as $campo){
                    
                    include('conexao.php');
                    $sql = "Select filmes.nome, filmes.capa, filmes.idFilme from filmes 
                            inner join generoFilmes on filmes.idFilme = generofilmes.filmes_idFilme 
                            where generoFilmes.generos_idGenero  = '".$campo['generos_idGenero']."' order by nome asc;";

                    $result2 = mysqli_query($conn, $sql);
                    mysqli_close($conn);
        
                    if(mysqli_num_rows($result2) > 0){
                        $array2 = array();
        
                        while($linha2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
                            array_push($array2, $linha2);
                        }
                        
                        foreach($array2 as $campo2){
                            $avaliacao = avaliacao($campo2['idFilme'], 'idFilme');
                            $possui = stripos($jaMostrado, $campo2['idFilme']);
                            if(stripos($jaMostrado, $campo2['idFilme']) == false && $id !== $campo2['idFilme']){
                                $jaMostrado .= " ".$campo2['idFilme']." ";
                                if($avaliacao >= 7){
                                    $lista .= "<a href = 'http://localhost/senaiplus/assistir.php?id=".$campo2['idFilme']."&tipo=filme'><div class='col mb-3 heightcard' >"
                                                ."<div class='card h-100'>"
                                                    ."<!-- nome badge-->"
                                                    ."<div class='badge bg-dark text-white position-absolute' style='top: 0.5rem; right: 0.5rem'>".mb_strimwidth($campo2['nome'], 0, 30, "...")."</div>"
                                                    ."<!-- filme capa image-->"
                                                    ."<img class='card-img'  src='".$campo2['capa']."' alt='...' />"
                                                    ."<!-- Product details-->"
                                                    ."<div class='badge bg-green text-white position-absolute' style='bottom: 0.5rem; left: 0.5rem'><b>&#9733 ".$avaliacao."</b></div>"              
                                                    ."</div>"
                                                ."</div></a>";
                                }if($avaliacao >= 5 && $avaliacao < 7){
                                    $lista .= "<a href = 'http://localhost/senaiplus/assistir.php?id=".$campo2['idFilme']."&tipo=filme'><div class='col mb-3 heightcard' >"
                                                ."<div class='card h-100'>"
                                                    ."<!-- nome badge-->"
                                                    ."<div class='badge bg-dark text-white position-absolute' style='top: 0.5rem; right: 0.5rem'>".mb_strimwidth($campo2['nome'], 0, 30, "...")."</div>"
                                                    ."<!-- filme capa image-->"
                                                    ."<img class='card-img'  src='".$campo2['capa']."' alt='...' />"
                                                    ."<!-- Product details-->"
                                                    ."<div class='badge bg-orange text-white position-absolute' style='bottom: 0.5rem; left: 0.5rem'><b>&#9733 ".$avaliacao."</b></div>"              
                                                    ."</div>"
                                                ."</div></a>";
                                }if($avaliacao < 5){
                                    $lista .= "<a href = 'http://localhost/senaiplus/assistir.php?id=".$campo2['idFilme']."&tipo=filme'><div class='col mb-3 heightcard' >"
                                                ."<div class='card h-100'>"
                                                    ."<!-- nome badge-->"
                                                    ."<div class='badge bg-dark text-white position-absolute' style='top: 0.5rem; right: 0.5rem'>".mb_strimwidth($campo2['nome'], 0, 30, "...")."</div>"
                                                    ."<!-- filme capa image-->"
                                                    ."<img class='card-img'  src='".$campo2['capa']."' alt='...' />"
                                                    ."<!-- Product details-->"
                                                    ."<div class='badge bg-red text-white position-absolute' style='bottom: 0.5rem; left: 0.5rem'><b>&#9733 ".$avaliacao."</b></div>"              
                                                    ."</div>"
                                                ."</div></a>";
                                }
                            }     
                        }   
                    }
             
                }
            }
        }
        $lista .= "</div>";    
    return $lista;    
    }        

