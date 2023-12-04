<?php   
    Generos();
    
    function generos(){
        $pesquisa = $_GET['p'];
        $search = $_GET['s'];
        header("location: ../index.php?s=".$search."&p=".$pesquisa);
    
    }
    
    
?>