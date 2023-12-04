<?php
    //retornar listagem de usuarios
    function listaGeneros(){
        $lista = "<ul class='dropdown-menu' aria-labelledby='navbarDropdown'>";
                   
        include('conexao.php');
        $sql = "Select * from generos;";

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

        if(mysqli_num_rows($result) > 0){
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);
            }
            
            foreach($array as $campo){
                $lista .= "<form method='POST' class='d-flex' action= 'php/functionSearchGeneros.php?s=".$campo['idGenero']."&p=Genero' >"
                                ."<button class='dropdown-item' type='submit' id='i".$campo['idGenero']."' name='n".$campo['idGenero']."' value='".$campo['descGenero']."'>"
                                    .$campo['descGenero']
                                ."</button>"
                            ."</form>" ;              
            }
            
        }
        $lista .= "</ul>";
        return $lista;   
    }

    

