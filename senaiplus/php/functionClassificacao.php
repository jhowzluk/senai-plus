<?php
    //retornar listagem de classificação indicativa 
    function listaClassificacao($tipoStream){

        if($tipoStream == 'f') {

            $lista = "<select class='form-select' name='nClassificacaoFilme' aria-label='Default select example'>"
                        ."<option selected disabled>Selecione...</option>";

            include('conexao.php');
            $sql = "Select * from classificacao;";

            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);

            if(mysqli_num_rows($result) > 0){
                $array = array();

                while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    array_push($array, $linha);
                }
                
                foreach($array as $campo){
                    $lista .= "<option value=".$campo['idClassificacao'].">".$campo['descClassificacao']."</option>" ;
                    
                }
                
            }
            
            $lista .= "</select>";

        }else if($tipoStream == 's'){

            $lista = "<select class='form-select' name='nClassificacaoSerie' aria-label='Default select example'>"
                        ."<option selected disabled>Selecione...</option>";

            include('conexao.php');
            $sql = "Select * from classificacao;";

            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);

            if(mysqli_num_rows($result) > 0){
                $array = array();

                while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    array_push($array, $linha);
                }
                
                foreach($array as $campo){
                    $lista .= "<option value=".$campo['idClassificacao'].">".$campo['descClassificacao']."</option>" ;
                    
                }
                
            }
            
            $lista .= "</select>";

        }

        return $lista;   
    }