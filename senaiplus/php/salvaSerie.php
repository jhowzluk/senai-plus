<?php

    include('function.php');

    $nomeSerie = $_POST["nNomeSerie"];
    $capaSerie = $_POST["nCapaSerie"];
    $carouselSerie = $_POST["nCarouselSerie"];
    $sinopseSerie = $_POST["nSinopseSerie"];
    $lancamentoSerie = $_POST["nLancamentoSerie"];
    $estudioSerie = $_POST["nEstudioSerie"];
    $classificacaoSerie = $_POST["nClassificacaoSerie"];
    $idSerie = $_GET["id"];

    // var_dump($idSerie);
    // die();

    include('conexao.php');

    if($idSerie == "0") {

        $id = proximoIdTabela("series", "idSerie");

        //insert na tabela series
        $sql1 = "INSERT "
            ."INTO series (idSerie, nome, sinopse, lancamento," 
            ."estudio, classificacao_idClassificacao) "
            ."VALUES (".$id.", "
            ."'".$nomeSerie."', "
            ."'".$sinopseSerie."',"
            ."'".$lancamentoSerie."',"
            ."'".$estudioSerie."',"
            ."'".$classificacaoSerie."');";

        $result = mysqli_query($conn,$sql1);    

        for ($c = 1; $c < 14; $c++) {

            if ($_POST["nGenero".$c.""] == "on") {

                //insert na tabela generoseries
                $sql2 = "INSERT "
                    ."INTO generoseries (series_idSerie, generos_idGenero) " 
                    ."VALUES (".$id.", ".$c.");";
                    $result = mysqli_query($conn,$sql2);    
            }

        }

    } else {

        //update na tabela series 
        $sql1 = "UPDATE series "
            ."SET nome='".$nomeSerie."', sinopse='".$sinopseSerie."', lancamento='".$lancamentoSerie."'," 
            ."estudio='".$estudioSerie."', classificacao_idClassificacao='".$classificacaoSerie."' "
            ."WHERE idSerie='".$idSerie."';";

        $result = mysqli_query($conn,$sql1);  
        
        $sql2 = "DELETE FROM generoseries "
        ."WHERE series_idSerie='".$idSerie."';";

        $result = mysqli_query($conn,$sql2);   

        for ($c = 1; $c < 14; $c++) {

            if ($_POST["nGenero".$c.""] == "on") {

                //insert na tabela generoseries
                $sql3 = "INSERT "
                    ."INTO generoseries (series_idSerie, generos_idGenero) " 
                    ."VALUES (".$idSerie.", ".$c.");";
                    $result = mysqli_query($conn,$sql3);    
            }

        }

    }


    mysqli_close($conn);
    

     //imagem capa 
     if($_FILES['nCapaSerie']['tmp_name'] != ""){

        //Usar o mesmo nome do arquivo original
        //$nomeArq = $_FILES['Foto']['name'];
        //...
        //OU
        //Pega a extensão do arquivo e cria um novo nome pra ele (MD5 do nome original)
        $extensao = pathinfo($_FILES['nCapaSerie']['name'], PATHINFO_EXTENSION);
        $novoNome = md5($_FILES['nCapaSerie']['name']).'.'.$extensao;        
        
        //Verificar se o diretório existe, ou criar a pasta
        if(is_dir('../image/serie/capa/'.$id.'/')){
            //Existe
            $diretorio = '../image/serie/capa/'.$id.'/';
        }else{
            //Criar pq não existe
            $diretorio = mkdir('../image/serie/capa/'.$id.'/');
        }

        //Cria uma cópia do arquivo local na pasta do projeto
        move_uploaded_file($_FILES['nCapaSerie']['tmp_name'], '../image/serie/capa/'.$id.'/'.$novoNome);

        //Caminho que será salvo no banco de dados
        $dirImagem = 'image/serie/capa/'.$id.'/'.$novoNome;

        include("conexao.php");
        //UPDATE
        $sql = "UPDATE series "
                ." SET capa = '$dirImagem' "
                ." WHERE idSerie = $id;";
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);
    }

     //imagem carousel
     if($_FILES['nCarouselSerie']['tmp_name'] != ""){

        //Usar o mesmo nome do arquivo original
        //$nomeArq = $_FILES['Foto']['name'];
        //...
        //OU
        //Pega a extensão do arquivo e cria um novo nome pra ele (MD5 do nome original)
        $extensao = pathinfo($_FILES['nCarouselSerie']['name'], PATHINFO_EXTENSION);
        $novoNome = md5($_FILES['nCarouselSerie']['name']).'.'.$extensao;        
        
        //Verificar se o diretório existe, ou criar a pasta
        if(is_dir('../image/serie/carousel/'.$id.'/')){
            //Existe
            $diretorio = '../image/serie/carousel/'.$id.'/';
        }else{
            //Criar pq não existe
            $diretorio = mkdir('../image/serie/carousel/'.$id.'/');
        }

        //Cria uma cópia do arquivo local na pasta do projeto
        move_uploaded_file($_FILES['nCarouselSerie']['tmp_name'], '../image/serie/carousel/'.$id.'/'.$novoNome);

        //Caminho que será salvo no banco de dados
        $dirImagem = 'image/serie/carousel/'.$id.'/'.$novoNome;

        include("conexao.php");
        //UPDATE
        $sql = "UPDATE series "
                ." SET carouselimage = '$dirImagem' "
                ." WHERE idSerie = $id;";
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);
    }

    header('location: ../index.php');

?>  