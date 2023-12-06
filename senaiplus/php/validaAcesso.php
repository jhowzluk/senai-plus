<?php
    
    session_start();    

    $email = stripslashes($_POST["nEmailUsuario"]);
    $senha = stripslashes($_POST["nSenhaUsuario"]);

    $_SESSION['msgLogin'] = '';

    include('conexao.php');

    $sql = "SELECT * "
           ."FROM usuarios "
           ."WHERE email = '".$email."' "
           ."AND senha = md5('".$senha."');";

    var_dump($sql);
    die();

    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);
    

    if(mysqli_num_rows($result) > 0) {

        $dados = mysqli_fetch_array($result);
        $tipoUsuario = $dados['acessos_idAcesso'];

        switch($tipoUsuario) {
                case 1:
                    
                    header('location: ../telaCadastrado.php');

                    break;

                case 2:

                    header('location: ../telaAdmin.php');
                    
                    break;

                default:
                    
                    $_SESSION['msgLogin'] = 'Usuário ou senha incorretos.';
                    header('location: ../login.php');
        }

    }  else  {

        $_SESSION['msgLogin'] = 'Usuário ou senha incorretos.';
        header('location: ../login.php');

    }
    
?>