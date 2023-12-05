<?php

    function listaAcesso(){

        $lista = "<select class='form-select' name='nAcessoUsuario' aria-label='Default select example'>"
                    ."<option selected disabled>Selecione...</option>";

        include('conexao.php');
        $sql = "Select * from acessos;";

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

        if(mysqli_num_rows($result) > 0){
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);
            }
            
            foreach($array as $campo){
                $lista .= "<option value=".$campo['idAcesso'].">".$campo['descAcesso']."</option>" ;
                
            }
            
        }
        
        $lista .= "</select>";
        return $lista;   
    }

?>