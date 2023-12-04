<?php

function classificacao($idclassificacao){
        include('conexao.php');

        $sql = "Select descClassificacao from classificacao
                where idClassificacao = ".$idclassificacao.";";
        
            
        
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
                $classificacao = $campo['descClassificacao'];            
            }

            switch($classificacao){
                case 'L':
                    $result = "<div class='badge bg-green text-white ' style='bottom: 0rem; left: 0.1rem'><b>".$classificacao."</b></div>";
                    break;
                case 10:
                    $result = "<div class='badge bg-blue text-white ' style='bottom: 0rem; left: 0.1rem'><b>".$classificacao."</b></div>";
                    break;
                case 12:
                    $result = "<div class='badge bg-yellow text-white ' style='bottom: 0rem; left: 0.1rem'><b>".$classificacao."</b></div>";
                    break; 
                case 14:
                    $result = "<div class='badge bg-orange text-white ' style='bottom: 0rem; left: 0.1rem'><b> ".$classificacao."</b></div>";
                    break;
                case 16:
                    $result = "<div class='badge bg-red text-white ' style='bottom: 0rem; left: 0.1rem'><b>".$classificacao."</b></div>";
                    break;
                case 18:
                    $result = "<div class='badge bg-black1 text-white ' style='bottom: 0rem; left: 0.1rem'><b>".$classificacao."</b></div>";
                    break;           
            }
            
            
        }
        return $result;

}


?>