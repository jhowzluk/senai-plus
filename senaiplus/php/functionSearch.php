 <?php   
    Search();
    
    function Search(){
        $search = $_POST["nSearch"];
        if($search == ""){
            $pesquisa = 2;
            header("location: ../index.php?s=".$search."&p=".$pesquisa);
        }else{
            $pesquisa = 1;
            header("location: ../index.php?s=".$search."&p=".$pesquisa);
        }
        
        
    
    }
    
    
?>
