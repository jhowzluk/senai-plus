<?php 
    session_start();
    $_SESSION['logado'] = 0;
    date_default_timezone_set("America/Sao_Paulo");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Senai+ - Login</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="image/icons/s.png" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/loginstyle.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <div class="global-container">
            <div class="cardLogin login-form">
                <div class="card-body">
                    <h3 class="card-title text-center">SENAI+</h3>
                    <div class="card-text">
                        <!-- <div class="alert alert-danger alert-dismissible fade show" 
                        role="alert">Incorrect username or password.</div> -->
                        <form method="POST" action="php/validaAcesso.php">
                            <!-- to error: add class "has-danger" -->
                            <div class="form-group">
                                <label for="iEmail">Email</label>
                                <input type="email" class="form-control form-control-sm" id="iEmail" aria-describedby="emailHelp" name="nEmail">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="iSenha">Senha</label>
                                <input type="password" class="form-control form-control-sm" id="iSenha" name="nSenha">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                            <div class="sign-up">
                                Não possui uma conta? 
                                <a href="#">Registrar-se</a>
                            </div>
                            
                        </form>    

                        <br>

                        <p class="mb-1 text-danger" align="center">
                            <?php 
                                if (isset($_SESSION['msg-login'])){
                                    echo $_SESSION['msg-login'];
                                    session_destroy();
                                }
                            ?>
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
    
        <!-- jQuery -->
        <script src="app/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="app/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>                   
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>