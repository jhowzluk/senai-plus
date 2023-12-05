<?php

    include('function.php');

    $nomeFilme = $_POST["nNomeFilme"];
    $videoFilme = $_POST["nVideoFilme"];
    $capaFilme = $_POST["nCapaFilme"];
    $carouselFilme = $_POST["nCarouselFilme"];
    $sinopseFilme = $_POST["nSinopseFilme"];
    $lancamentoFilme = $_POST["nLancamentoFilme"];
    $tempoFilme = $_POST["nTempoFilme"];
    $estudioFilme = $_POST["nEstudioFilme"];
    $diretorFilme = $_POST["nDiretorFilme"];
    $elencoFilme = $_POST["nElencoFilme"];
    $classificacaoFilme = $_POST["nClassificacaoFilme"];
    $idFilme = $_GET["id"];

    // var_dump($idFilme);
    // die();

    $hora_minuto = explode(":", $tempoFilme);
    $horaFilme = $hora_minuto[0];
    $minutoFilme = $hora_minuto[1];

    include('conexao.php');

    if($idFilme == "0") {

        $id = proximoIdTabela("filmes", "idFilme");

        //insert na tabela filmes
        $sql1 = "INSERT "
            ."INTO filmes (idFilme, nome, sinopse, lancamento," 
            ."hora, minuto, estudio, diretor, elenco, classificacao_idClassificacao) "
            ."VALUES (".$id.", "
            ."'".$nomeFilme."', "
            ."'".$sinopseFilme."',"
            ."'".$lancamentoFilme."',"
            ."'".$horaFilme."', "
            ."'".$minutoFilme."', "
            ."'".$estudioFilme."',"
            ."'".$diretorFilme."',"
            ."'".$elencoFilme."', "
            ."'".$classificacaoFilme."');";

    
        $result = mysqli_query($conn,$sql1);    

        for ($c = 1; $c < 14; $c++) {

            if ($_POST["nGenero".$c.""] == "on") {

                //insert na tabela generofilmes
                $sql2 = "INSERT "
                    ."INTO generofilmes (filmes_idFilme, generos_idGenero) " 
                    ."VALUES (".$id.", ".$c.");";
                    $result = mysqli_query($conn,$sql2);    
            }

        }

    } else {

        //update na tabela filmes 
        $sql1 = "UPDATE filmes "
            ."SET nome='".$nomeFilme."', sinopse='".$sinopseFilme."', lancamento='".$lancamentoFilme."'," 
            ."hora='".$horaFilme."', minuto='".$minutoFilme."', estudio='".$estudioFilme."', diretor='".$diretorFilme."',"
            ."elenco='".$elencoFilme."', classificacao_idClassificacao='".$classificacaoFilme."' "
            ."WHERE idFilme='".$idFilme."';";

        $result = mysqli_query($conn,$sql1);  
        
        $sql2 = "DELETE FROM generofilmes "
        ."WHERE filmes_idFilme='".$idFilme."';";

        $result = mysqli_query($conn,$sql2);   

        for ($c = 1; $c < 14; $c++) {

            if ($_POST["nGenero".$c.""] == "on") {

                //insert na tabela generofilmes
                $sql3 = "INSERT "
                    ."INTO generofilmes (filmes_idFilme, generos_idGenero) " 
                    ."VALUES (".$idFilme.", ".$c.");";
                    $result = mysqli_query($conn,$sql3);    
            }

        }

    }


    mysqli_close($conn);


    //video
    if($_FILES['nVideoFilme']['tmp_name'] != ""){

        //Usar o mesmo nome do arquivo original
        //$nomeArq = $_FILES['Foto']['name'];
        //...
        //OU
        //Pega a extensão do arquivo e cria um novo nome pra ele (MD5 do nome original)
        $extensao = pathinfo($_FILES['nVideoFilme']['name'], PATHINFO_EXTENSION);
        $novoNome = md5($_FILES['nVideoFilme']['name']).'.'.$extensao;        
        
        //Verificar se o diretório existe, ou criar a pasta
        if(is_dir('../video/filme/'.$id.'/')){
            //Existe
            $diretorio = '../video/filme/'.$id.'/';
        }else{
            //Criar pq não existe
            $diretorio = mkdir('../video/filme/'.$id.'/');
        }

        //Cria uma cópia do arquivo local na pasta do projeto
        move_uploaded_file($_FILES['nVideoFilme']['tmp_name'], '../video/filme/'.$id.'/'.$novoNome);

        //Caminho que será salvo no banco de dados
        $dirVideo = 'video/filme/'.$id.'/'.$novoNome;

        include("conexao.php");
        //UPDATE
        $sql = "UPDATE filmes "
                ." SET video = '$dirVideo' "
                ." WHERE idFilme = $id;";
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);
    }

     //imagem capa 
     if($_FILES['nCapaFilme']['tmp_name'] != ""){

        //Usar o mesmo nome do arquivo original
        //$nomeArq = $_FILES['Foto']['name'];
        //...
        //OU
        //Pega a extensão do arquivo e cria um novo nome pra ele (MD5 do nome original)
        $extensao = pathinfo($_FILES['nCapaFilme']['name'], PATHINFO_EXTENSION);
        $novoNome = md5($_FILES['nCapaFilme']['name']).'.'.$extensao;        
        
        //Verificar se o diretório existe, ou criar a pasta
        if(is_dir('../image/filme/capa/'.$id.'/')){
            //Existe
            $diretorio = '../image/filme/capa/'.$id.'/';
        }else{
            //Criar pq não existe
            $diretorio = mkdir('../image/filme/capa/'.$id.'/');
        }

        //Cria uma cópia do arquivo local na pasta do projeto
        move_uploaded_file($_FILES['nCapaFilme']['tmp_name'], '../image/filme/capa/'.$id.'/'.$novoNome);

        //Caminho que será salvo no banco de dados
        $dirImagem = 'image/filme/capa/'.$id.'/'.$novoNome;

        include("conexao.php");
        //UPDATE
        $sql = "UPDATE filmes "
                ." SET capa = '$dirImagem' "
                ." WHERE idFilme = $id;";
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);
    }

     //imagem carousel
     if($_FILES['nCarouselFilme']['tmp_name'] != ""){

        //Usar o mesmo nome do arquivo original
        //$nomeArq = $_FILES['Foto']['name'];
        //...
        //OU
        //Pega a extensão do arquivo e cria um novo nome pra ele (MD5 do nome original)
        $extensao = pathinfo($_FILES['nCarouselFilme']['name'], PATHINFO_EXTENSION);
        $novoNome = md5($_FILES['nCarouselFilme']['name']).'.'.$extensao;        
        
        //Verificar se o diretório existe, ou criar a pasta
        if(is_dir('../image/filme/carousel/'.$id.'/')){
            //Existe
            $diretorio = '../image/filme/carousel/'.$id.'/';
        }else{
            //Criar pq não existe
            $diretorio = mkdir('../image/filme/carousel/'.$id.'/');
        }

        //Cria uma cópia do arquivo local na pasta do projeto
        move_uploaded_file($_FILES['nCarouselFilme']['tmp_name'], '../image/filme/carousel/'.$id.'/'.$novoNome);

        //Caminho que será salvo no banco de dados
        $dirImagem = 'image/filme/carousel/'.$id.'/'.$novoNome;

        include("conexao.php");
        //UPDATE
        $sql = "UPDATE filmes "
                ." SET carouselimage = '$dirImagem' "
                ." WHERE idFilme = $id;";
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);
    }

    header('location: ../index.php');

?>  