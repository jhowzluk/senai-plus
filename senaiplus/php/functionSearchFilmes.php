<?php   
    Filmes();
    
    function Filmes(){
        $pesquisa = $_POST["nFilmes"];
        $search = "";
        header("location: ../index.php?s=".$search."&p=".$pesquisa);
    
    }
    
    
?>