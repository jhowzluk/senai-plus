<?php
    
    session_start();    

    $usuario = stripslashes($_POST["nUsuario"]);
    $senha = stripslashes($_POST["nSenha"]);

    $_SESSION['msgLogin'] = '';

    include('../conexaoBD/conexao.php');

    $sql = "SELECT * "
           ."FROM usuario "
           ."WHERE Login = '".$usuario."' "
           ."AND Senha = md5('".$senha."');";

    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);
    

    if(mysqli_num_rows($result) > 0) {

        $dados = mysqli_fetch_array($result);
        $tipoUsuario = $dados['idTipoUsuario'];
        $ativo = $dados['Ativo'];

        switch($tipoUsuario) {
                case 1:

                    if($ativo == "S"){
                        header('location: ../../telaAdmin.php');
                    } else {
                        $_SESSION['msgLogin'] = 'Usuário inativado.';
                        header('location: ../../login.php');
                    }    

                    break;

                case 2:

                    if($ativo == "S"){
                        header('location: ../../telaEmpresa.php');
                    } else {
                        $_SESSION['msgLogin'] = 'Usuário inativado.';
                        header('location: ../../login.php');
                    }
                    
                    break;

                case 3:

                    if($ativo == "S"){
                        header('location: ../../telaComum.php');
                    } else {
                        $_SESSION['msgLogin'] = 'Usuário inativado.';
                        header('location: ../../login.php');
                    }
                    
                    break;
                
                default:
                    
                    $_SESSION['msgLogin'] = 'Usuário ou senha incorretos.';
                    header('location: ../../login.php');
        }

    }  else  {

        $_SESSION['msgLogin'] = 'Usuário não cadastrado.';
        header('location: ../../login.php');

    }
    
?>