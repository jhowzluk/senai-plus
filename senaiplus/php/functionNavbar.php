<?php
    //retornar listagem de gêneros
    function listaGeneros(){
        $lista = "<ul class='dropdown-menu' aria-labelledby='navbarDropdown'>";
                   
        include('conexao.php');
        $sql = "Select descGenero from generos;";

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

        if(mysqli_num_rows($result) > 0){
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);
            }
            
            foreach($array as $campo){
                $lista .= "<li><a class='dropdown-item' href='#!'>".$campo['descGenero']."</a></li>" ;              
            }
            
        }
        $lista .= "</ul>";
        return $lista;   
    }

