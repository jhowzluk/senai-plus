<?php

    include('function.php');

    $nomeUsuario = $_POST["nNomeUsuario"];
    $sobrenomeUsuario = $_POST["nSobrenomeUsuario"];
    $telefone = $_POST["nTelefone"];
    $cpf = $_POST["nCpfUsuario"];
    $email = $_POST["nEmailUsuario"];
    $senha = $_POST["nSenhaUsuario"];
    $acesso = $_POST["nAcessoUsuario"];
    $idUsuario = $_GET["id"];

    include('conexao.php');


    if($idUsuario == "0") {

        $id = proximoIdTabela("usuarios", "idUsuario");

        //insert na tabela usuarios
        $sql = "INSERT "
            ."INTO usuarios (idUsuario, nome, sobrenome, telefone," 
            ."cpf, email, senha, acessos_idAcesso) "
            ."VALUES (".$id.", "
            ."'".$nomeUsuario."', "
            ."'".$sobrenomeUsuario."', "
            ."'".$telefone."', "
            ."'".$cpf."', "
            ."'".$email."', "
            ."MD5('".$senha."'), "
            ."'".$acesso."');";

        $result = mysqli_query($conn,$sql);    

    } else {

        $sql1 = "Select senha from usuarios where idUsuario = ".$idUsuario.";";

        $result = mysqli_query($conn, $sql1);

        if(mysqli_num_rows($result) > 0){
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);
            }
            
            foreach($array as $campo){ 
                $senBanco = $campo['senha'];
            }
            
        }
        
        if($senha == $senBanco) { 

            //update na tabela usuarios 
            $sql = "UPDATE usuarios "
                ."SET nome='".$nomeUsuario."', sobrenome='".$sobrenomeUsuario."', telefone='".$telefone."', " 
                ."cpf='".$cpf."', email='".$email."', senha= '".$senha."', acessos_idAcesso='".$acesso."' "
                ."WHERE idUsuario='".$idUsuario."';";

            $result = mysqli_query($conn,$sql);   

        } else {

            //update na tabela usuarios 
            $sql = "UPDATE usuarios "
                ."SET nome='".$nomeUsuario."', sobrenome='".$sobrenomeUsuario."', telefone='".$telefone."', " 
                ."cpf='".$cpf."', email='".$email."', senha= MD5('".$senha."'), acessos_idAcesso='".$acesso."' "
                ."WHERE idUsuario='".$idUsuario."';";

            $result = mysqli_query($conn,$sql);   

        }

    }

    mysqli_close($conn);

    header('location: ../index.php');

?>