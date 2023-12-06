<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include('function.php');

$email = stripcslashes($_POST['nEmail']);
$senha = stripcslashes($_POST['nSenha']);

$_SESSION['email']     = $email;
$_SESSION['senha']     = $senha;
$_SESSION['msg-login'] = '';

include('conexao.php');
$sql = "SELECT count(*) as QtdUsuario "
        ." FROM usuarios "
        ." WHERE email = '".$email."';";

$resultLogin = mysqli_query($conn,$sql);
mysqli_close($conn);

if (mysqli_num_rows($resultLogin) > 0) {
    
    $arrayLogin = array();
    
    while ($linha = mysqli_fetch_array($resultLogin, MYSQLI_ASSOC)) {
        array_push($arrayLogin,$linha);
    }
    
    foreach ($arrayLogin as $total) {
        
        if($total['QtdUsuario'] > 0){
            
           
            $resultAcesso = validaUsuario($email, $senha);
            
            if (mysqli_num_rows($resultAcesso)  > 0) {
                
                $arrayUsuarios = array();
            
                while ($linha = mysqli_fetch_array($resultAcesso, MYSQLI_ASSOC)) {
                    array_push($arrayUsuarios,$linha);
                }
                
                foreach ($arrayUsuarios as $value) {
                    
                    $idUsuario = $value['idUsuario'];


                    $_SESSION['logado']    = 1;
                    $_SESSION['msg-login'] = '';
                    unset($_SESSION['email']);
                    unset($_SESSION['senha']);
                    
                    //Perfil
                    carregaPerfil($idUsuario);
                    
                    if($_SESSION['idTipoUsuario'] == 1){ 
                        //Administração
                        $_SESSION['TipoUsuario'] = 'administrador';
                    }elseif($_SESSION['idTipoUsuario'] == 2){
                        //Gestão
                        $_SESSION['TipoUsuario'] = 'gestor';
                    }elseif($_SESSION['idTipoUsuario'] == 3){
                        //Operação
                        $_SESSION['TipoUsuario'] = 'operador';
                    }elseif($_SESSION['idTipoUsuario'] == 99){
                        //Super Admin
                        $_SESSION['TipoUsuario'] = 'super-admin';
                    }else{
                        //Indefinido
                        $_SESSION['TipoUsuario'] = 'indefinido';
                    }

                    //Acesso inicial ao painel conforme perfil de acesso
                    if($_SESSION['idTipoUsuario'] == '3'){
                        header('location:../#');
                    }else{
                        header('location:../#');
                    }
    
                    
                }
            }else {
                unset($_SESSION['idUsuario']);
                limpaEmailSenha();
                $_SESSION['msg-login'] = 'Senha incorreta.';
                header('location: '.$_SERVER['HTTP_REFERER']);      
            }

        }else{
            unset($_SESSION['idUsuario']);
            limpaEmailSenha();
            $_SESSION['msg-login'] = 'Usuário não cadastrado.';
            header('location: '.$_SERVER['HTTP_REFERER']);
        }
    }
}else{
    unset($_SESSION['idUsuario']);
    limpaEmailSenha();
    $_SESSION['msg-login'] = 'Falha no acesso - E-mail.';
    header('location: '.$_SERVER['HTTP_REFERER']);
}

//Função para limpar e-mail e senha da sessão
function limpaEmailSenha(){
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
}

?>