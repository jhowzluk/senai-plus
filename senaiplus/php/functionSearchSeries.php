<?php   
    Series();
    
    function Series(){
        $pesquisa = $_POST["nSeries"];
        $search = "";
        header("location: ../index.php?s=".$search."&p=".$pesquisa);
    
    }
    
    
?>