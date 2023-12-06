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

    // var_dump($videoEpisodio);
    // die();

    $hora_minuto = explode(":", $tempoEpisodio);
    $horaEpisodio = $hora_minuto[0];
    $minutoEpisodio = $hora_minuto[1];

    include('conexao.php');

    if($idEpisodio == "0") {

        $id = proximoIdTabela("episodios", "idEpisodio");

        //insert na tabela episodios
        $sql = "INSERT "
            ."INTO episodios (idEpisodio, nome, temporada, nrEpisodios, " 
            ."sinopse, lancamento, series_idSerie, hora, minutos, diretor, elenco) "
            ."VALUES (".$id.", "
            ."'".$nomeEpisodio."', "
            ."'".$nrTemporada."', "
            ."'".$nrEpisodio."', "
            ."'".$sinopseEpisodio."', "
            ."'".$lancamentoEpisodio."', "
            ."'".$serieEpisodio."', "
            ."'".$horaEpisodio."', "
            ."'".$minutoEpisodio."', "
            ."'".$diretorEpisodio."', "
            ."'".$elencoEpisodio."'); ";
    
        $result = mysqli_query($conn,$sql);    

    } else {
    
        //update na tabela episodios 
        $sql = "UPDATE episodios "
            ."SET nome='".$nomeEpisodio."', temporada='".$nrTemporada."', nrEpisodios='".$nrEpisodio."'," 
            ."sinopse='".$sinopseEpisodio."', lancamento='".$lancamentoEpisodio."', series_idSerie='".$serieEpisodio."', hora='".$horaEpisodio."',"
            ."minutos='".$minutoEpisodio."', diretor='".$diretorEpisodio."', elenco='".$elencoEpisodio."' "
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
        if(is_dir('../video/serie/'.$serieEpisodio.'/'.$nrEpisodio.'/')){
            //Existe
            $diretorio = '../video/serie/'.$serieEpisodio.'/'.$nrEpisodio.'/';
        }else{
            //Criar pq não existe
            $diretorio = mkdir('../video/serie/'.$serieEpisodio.'/'.$nrEpisodio.'/');
        }

        //Cria uma cópia do arquivo local na pasta do projeto
        move_uploaded_file($_FILES['nVideoEpisodio']['tmp_name'], '../video/serie/'.$serieEpisodio.'/'.$nrEpisodio.'/'.$novoNome);

        //Caminho que será salvo no banco de dados
        $dirVideo = 'video/serie/'.$serieEpisodio.'/'.$nrEpisodio.'/'.$novoNome;

        include("conexao.php");
        //UPDATE
        $sql = "UPDATE episodios "
                ." SET video = '$dirVideo' "
                ." WHERE idEpisodio = $id;";
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);
    }

    header('location: ../index.php');

?>  