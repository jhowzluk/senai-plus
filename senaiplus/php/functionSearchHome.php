<?php   
    Home();
    
    function Home(){
        $pesquisa = 2;
        $search = "";
        header("location: ../index.php?s=".$search."&p=".$pesquisa);
    
    }
    
    
?>