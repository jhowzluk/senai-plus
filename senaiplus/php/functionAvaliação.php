<?php

function avaliacao($idvideo,$video){
        include('conexao.php');

        $sql = "Select avaliacao from avaliacoes
                where ".$video." = ".$idvideo.";";
        
            
        
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        $vezes = 0;
        $positivo = 0;

        if(mysqli_num_rows($result) > 0){
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);
            }
            

            foreach($array as $campo){
                $vezes = $vezes + 1;
                if($campo['avaliacao'] == 1){
                    $positivo = $positivo + 1;
                }             
            }
            
            
        }
        if($vezes == 0){
            $result = 10;
        }else{
            $positivo = $positivo * 100;
            $result = $positivo / $vezes;
            $result = $result / 10;
        }
            
        
        return mb_strimwidth($result, 0, 3, );

}


?>