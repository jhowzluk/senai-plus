<?php
    include ('functionCatalogo.php');
    include ('functionCarousel.php');
    include ('functionNavbar.php');
    include ('functionClassificacao.php');
    include ('functionSerie.php');
    include ('functionCrudFilme.php');
    include ('functionCrudSerie.php');
    include ('functionCrudEpisodio.php');
    include ('functionCrudUsuario.php');
    include ('functionAcesso.php');

    function proximoIdTabela($tabela, $coluna){

        $id = "";
    
        include("conexao.php");
        $sql = "SELECT MAX(".$coluna.") AS Maior FROM ".$tabela.";";        
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);
    
        //Validar se tem retorno do BD
        if (mysqli_num_rows($result) > 0) {
                    
            $array = array();
            
            while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                array_push($array,$linha);
            }
            
            foreach ($array as $coluna) {            
                //***Verificar os dados da consulta SQL
                $id = $coluna["Maior"] + 1;
            }        
        } 
    
        return $id;
    } 
    
    function validaUsuario($email, $senha) {

        include("conexao.php");
        $sql = "SELECT * FROM usuarios "
            ."WHERE email='".$email."' AND senha= MD5('".$senha."'); ";

        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);

        return $result;

    }
?>