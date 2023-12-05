<?php

    include('function.php');

    $nomeEpisodio = $_POST["nNomeEpisodio"];
    $nrTemporada = $_POST["nTemporadaEpisodio"];
    $nrEpisodio = $_POST["nNumeroEpisodio"];
    $videoEpisodio = $_POST["nVideoEpisodio"];
    $sinopseEpisodio = $_POST["nSinopseEpisodio"];
    $lancamentoEpisodio = $_POST["nLancamentoEpisodio"];
    $serieEpisodio = $_POST["nSerieEpisodio"];
    $tempoEpisodio = $_POST["nTempoEpisodio"];
    $diretorEpisodio = $_POST["nDiretorEpisodio"];
    $elencoEpisodio = $_POST["nElencoEpisodio"];
    $idEpisodio = $_GET["id"];

    // var_dump($idEpisodio);
    // die();

    $hora_minuto = explode(":", $tempoEpisodio);
    $horaEpisodio = $hora_minuto[0];
    $minutoEpisodio = $hora_minuto[1];

    include('conexao.php');

    if($idEpisodio == "0") {

        $id = proximoIdTabela("episodios", "idEpisodio");

        //insert na tabela episodios
        $sql = "INSERT "
            ."INTO episodios (idEpisodio, nome, sinopse, lancamento," 
            ."hora, minuto, estudio, diretor, elenco, classificacao_idClassificacao) "
            ."VALUES (".$id.", "
            ."'".$nomeEpisodio."', "
            ."'".$sinopseEpisodio."',"
            ."'".$lancamentoEpisodio."',"
            ."'".$horaEpisodio."', "
            ."'".$minutoEpisodio."', "
            ."'".$estudioEpisodio."',"
            ."'".$diretorEpisodio."',"
            ."'".$elencoEpisodio."', "
            ."'".$classificacaoEpisodio."');";

    
        $result = mysqli_query($conn,$sql);    

    } else {

        //update na tabela episodios 
        $sql = "UPDATE episodios "
            ."SET nome='".$nomeEpisodio."', sinopse='".$sinopseEpisodio."', lancamento='".$lancamentoEpisodio."'," 
            ."hora='".$horaEpisodio."', minuto='".$minutoEpisodio."', estudio='".$estudioEpisodio."', diretor='".$diretorEpisodio."',"
            ."elenco='".$elencoEpisodio."', classificacao_idClassificacao='".$classificacaoEpisodio."' "
            ."WHERE idEpisodio='".$idEpisodio."';";

        $result = mysqli_query($conn,$sql);  
    

    }


    mysqli_close($conn);


    //video
    if($_FILES['nVideoEpisodio']['tmp_name'] != ""){

        //Usar o mesmo nome do arquivo original
        //$nomeArq = $_FILES['Foto']['name'];
        //...
        //OU
        //Pega a extensão do arquivo e cria um novo nome pra ele (MD5 do nome original)
        $extensao = pathinfo($_FILES['nVideoEpisodio']['name'], PATHINFO_EXTENSION);
        $novoNome = md5($_FILES['nVideoEpisodio']['name']).'.'.$extensao;        
        
        //Verificar se o diretório existe, ou criar a pasta
        if(is_dir('../video/filme/'.$id.'/')){
            //Existe
            $diretorio = '../video/filme/'.$id.'/';
        }else{
            //Criar pq não existe
            $diretorio = mkdir('../video/filme/'.$id.'/');
        }

        //Cria uma cópia do arquivo local na pasta do projeto
        move_uploaded_file($_FILES['nVideoEpisodio']['tmp_name'], '../video/filme/'.$id.'/'.$novoNome);

        //Caminho que será salvo no banco de dados
        $dirVideo = 'video/filme/'.$id.'/'.$novoNome;

        include("conexao.php");
        //UPDATE
        $sql = "UPDATE episodios "
                ." SET video = '$dirVideo' "
                ." WHERE idEpisodio = $id;";
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);
    }

     //imagem capa 
     if($_FILES['nCapaEpisodio']['tmp_name'] != ""){

        //Usar o mesmo nome do arquivo original
        //$nomeArq = $_FILES['Foto']['name'];
        //...
        //OU
        //Pega a extensão do arquivo e cria um novo nome pra ele (MD5 do nome original)
        $extensao = pathinfo($_FILES['nCapaEpisodio']['name'], PATHINFO_EXTENSION);
        $novoNome = md5($_FILES['nCapaEpisodio']['name']).'.'.$extensao;        
        
        //Verificar se o diretório existe, ou criar a pasta
        if(is_dir('../image/filme/capa/'.$id.'/')){
            //Existe
            $diretorio = '../image/filme/capa/'.$id.'/';
        }else{
            //Criar pq não existe
            $diretorio = mkdir('../image/filme/capa/'.$id.'/');
        }

        //Cria uma cópia do arquivo local na pasta do projeto
        move_uploaded_file($_FILES['nCapaEpisodio']['tmp_name'], '../image/filme/capa/'.$id.'/'.$novoNome);

        //Caminho que será salvo no banco de dados
        $dirImagem = 'image/filme/capa/'.$id.'/'.$novoNome;

        include("conexao.php");
        //UPDATE
        $sql = "UPDATE episodios "
                ." SET capa = '$dirImagem' "
                ." WHERE idEpisodio = $id;";
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);
    }

     //imagem carousel
     if($_FILES['nCarouselEpisodio']['tmp_name'] != ""){

        //Usar o mesmo nome do arquivo original
        //$nomeArq = $_FILES['Foto']['name'];
        //...
        //OU
        //Pega a extensão do arquivo e cria um novo nome pra ele (MD5 do nome original)
        $extensao = pathinfo($_FILES['nCarouselEpisodio']['name'], PATHINFO_EXTENSION);
        $novoNome = md5($_FILES['nCarouselEpisodio']['name']).'.'.$extensao;        
        
        //Verificar se o diretório existe, ou criar a pasta
        if(is_dir('../image/filme/carousel/'.$id.'/')){
            //Existe
            $diretorio = '../image/filme/carousel/'.$id.'/';
        }else{
            //Criar pq não existe
            $diretorio = mkdir('../image/filme/carousel/'.$id.'/');
        }

        //Cria uma cópia do arquivo local na pasta do projeto
        move_uploaded_file($_FILES['nCarouselEpisodio']['tmp_name'], '../image/filme/carousel/'.$id.'/'.$novoNome);

        //Caminho que será salvo no banco de dados
        $dirImagem = 'image/filme/carousel/'.$id.'/'.$novoNome;

        include("conexao.php");
        //UPDATE
        $sql = "UPDATE episodios "
                ." SET carouselimage = '$dirImagem' "
                ." WHERE idEpisodio = $id;";
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);
    }

    header('location: ../index.php');

?>  