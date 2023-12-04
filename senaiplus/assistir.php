<?php
    include('php/function.php');
    
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Senai+</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="image/icons/senaiIcon.png" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        
        <?php echo navbar(); ?>

        <!-- Header-->
        <header class="bg-dark " style='margin-top: 50px;'>
            <div class='assistir-tela' >
                    <?php echo telaAssistir(); ?>      
            </div>       
        </header>
        <!-- Section-->

        <section class="py-5 bg-senaiplus" >
            
            <div class="container px-4 px-lg-5 mt-5" >
                
                
                <?php echo semelhantesFilmes($_GET['id'], $_GET['tipo']); ?>
                
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>