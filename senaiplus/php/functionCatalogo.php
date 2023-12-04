<?php
    //retornar listagem de catálogo
    function listaCatalogo(){
        $lista = "";
        include('conexao.php');
        $sql = "Select * from filmes;";

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

        if(mysqli_num_rows($result) > 0){
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);
            }
            
            foreach($array as $campo){
                $lista .= "<div class='col mb-3 heightcard'>"
                            ."<div class='card h-100'>"
                                ."<!-- nome badge-->"
                                ."<div class='badge bg-dark text-white position-absolute' style='top: 0.5rem; right: 0.5rem'>".mb_strimwidth($campo['nome'], 0, 30, "...")."</div>"
                                ."<!-- filme capa image-->"
                                ."<img class='card-img' src='".$campo['capa']."' alt='...' />"
                                ."<!-- Product details-->"            
                                ."</div>"
                            ."</div>";              
            }
            
        }
        return $lista;   
    }

