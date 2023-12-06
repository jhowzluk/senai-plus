<?php

function carregaUsuarios(){

    $html = '';

    include('conexao.php');
    $sql = "SELECT * FROM usuarios "
        ."INNER JOIN acessos "
        ."ON usuarios.acessos_idAcesso = acessos.idAcesso;";

    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);

    if (mysqli_num_rows($result) > 0) {	

        $lista = array();
        
        while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            array_push($lista,$linha);
        }

        foreach ($lista as $campo) {			
            
            $html .= 
            '<tr>'
                .'<td>'.$campo['idUsuario'].'</td>'
                .'<td>'.$campo['nome'].'</td>'
                .'<td>'.$campo['sobrenome'].'</td>'
                .'<td>'.$campo['telefone'].'</td>'
                .'<td>'.$campo['cpf'].'</td>'
                .'<td>'.$campo['descAcesso'].'</td>'
                .'<td align="center">'
                    .'<div class="row">'
                        .'<div class="col-md-12">'
                            .'<a href="#editarUsuarioModal'.$campo['idUsuario'].'" id="edit" class="edit" data-toggle="modal">'
                                .'<h6><i class="fa fa-edit text-info" data-toggle="tooltip" title="Alterar informações"></i></h6>'
                            .'</a>'
                        .'</div>'
                    .'</div>'
                .'</td>'
            .'</tr>'

            .'<div class="modal fade" id="editarUsuarioModal'.$campo['idUsuario'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'
                .'<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">'
                    .'<div class="modal-content">'
                        .'<div class="modal-header bg-info">'
                            .'<h4 class="modal-title" id="exampleModalLabel">Editar Usuário</h4>'
                            .'<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">'
                                .'<span aria-hidden="true">&times;</span>'
                            .'</button>'
                        .'</div>'
                        .'<form method="POST" action="php/salvaUsuario.php?id='.$campo['idUsuario'].'" enctype="multipart/form-data">'
                            .'<div class="modal-body">'
                                .'<div class="mb-3">'
                                    .'<label for="iNomeUsuario" class="form-label">Nome</label>'
                                    .'<input type="text" class="form-control" name="nNomeUsuario" id="iNomeUsuario" value="'.$campo['nome'].'">'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iSobrenomeUsuario" class="form-label">Sobrenome do Usuário</label>'
                                    .'<input class="form-control" type="text" name="nSobrenomeUsuario" id="iSobrenomeUsuario" value="'.$campo['sobrenome'].'">'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iTelefone" class="form-label">Telefone</label>'
                                    .'<input class="form-control" type="text" name="nTelefone" id="iTelefone" value="'.$campo['telefone'].'">'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iCpfUsuario" class="form-label">CPF</label>'
                                    .'<input class="form-control" type="text" maxlength="11" name="nCpfUsuario" id="iCpfUsuario" value="'.$campo['cpf'].'">'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iEmailUsuario" class="form-label">E-mail</label>'
                                    .'<input type="email" class="form-control" name="nEmailUsuario" id="iEmailUsuario" value="'.$campo['email'].'">'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iSenhaUsuario" class="form-label">Senha</label>'
                                    .'<input type="password" class="form-control" name="nSenhaUsuario" id="iSenhaUsuario" value="'.$campo['senha'].'">'
                                .'</div>'
                                .'<br>'
                                .'<div class="mb-3">'
                                    .'<label class="form-label">Acesso:&nbsp;&nbsp;</label>'
                                    .listaAcesso()
                                .'</div>'
                                .'<br>'
                            .'</div>'

                            .'<div class="modal-footer">'
                                .'<a href="telaUsuarios.php" class="btn btn-danger" title="Cancelar a operação">'
                                    .'<span>Cancelar</span>'
                                .'</a>'
                                .'<input type="submit" class="btn btn-success" value="Salvar" title="Salvar alteração">'
                            .'</div>'
                        .'</form>'
                    .'</div>'
                .'</div>'
            .'</div>';

        }

    }

    return $html;
}


?>