<?php

function carregaSeries(){

    $html = '';

    include('conexao.php');
    $sql = "SELECT * FROM series;"; 
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
                .'<td>'.$campo['idSerie'].'</td>'
                .'<td>'.$campo['nome'].'</td>'
                .'<td>'.$campo['lancamento'].'</td>'
                .'<td>'.$campo['estudio'].'</td>'
                .'<td align="center">'
                    .'<div class="row">'
                        .'<div class="col-md-12">'
                            .'<a href="#editarSerieModal'.$campo['idSerie'].'" id="edit" class="edit" data-toggle="modal">'
                                .'<h6><i class="fa fa-edit text-info" data-toggle="tooltip" title="Alterar informações"></i></h6>'
                            .'</a>'
                        .'</div>'
                    .'</div>'
                .'</td>'
            .'</tr>'

            .'<div class="modal fade" id="editarSerieModal'.$campo['idSerie'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'
                .'<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">'
                    .'<div class="modal-content">'
                        .'<div class="modal-header bg-info">'
                            .'<h4 class="modal-title" id="exampleModalLabel">Editar Serie</h4>'
                            .'<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">'
                                .'<span aria-hidden="true">&times;</span>'
                            .'</button>'
                        .'</div>'
                        .'<form method="POST" action="php/salvaSerie.php?id='.$campo['idSerie'].'" enctype="multipart/form-data">'
                            .'<div class="modal-body">'
                                .'<div class="mb-3">'
                                    .'<label for="iNomeSerie" class="form-label">Nome</label>'
                                    .'<input type="text" class="form-control" name="nNomeSerie" id="iNomeSerie" value="'.$campo['nome'].'">'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iCapaSerie" class="form-label">Imagem da capa</label>'
                                    .'<input class="form-control" type="file" name="nCapaSerie" id="iCapaSerie" accept="image/*" value="'.$campo['capa'].'">'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iCarouselSerie" class="form-label">Imagem do carousel</label>'
                                    .'<input class="form-control" type="file" name="nCarouselSerie" id="iCarouselSerie" accept="image/*" value="'.$campo['carouselimage'].'">'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iSinopseSerie" class="form-label">Sinopse</label>'
                                    .'<textarea class="form-control" name="nSinopseSerie" id="iSinopseSerie" rows="3" value="'.$campo['sinopse'].'">'.$campo['sinopse'].'</textarea>'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iLancamentoSerie" class="form-label">Data de lançamento</label>'
                                    .'<input type="date" class="form-control" name="nLancamentoSerie" id="iLancamentoSerie" value="'.$campo['lancamento'].'">'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iEstudioSerie" class="form-label">Estúdio</label>'
                                    .'<input type="text" class="form-control" name="nEstudioSerie" id="iEstudioSerie" value="'.$campo['estudio'].'">'
                                .'</div>'
                                .'<br>'
                                .'<div class="mb-3">'
                                    .'<label class="form-label">Classificação indicativa:&nbsp;&nbsp;</label>'
                                    .listaClassificacao("s")
                                .'</div>'
                                .'<br>'
                                .'<div class="row">'
                                    .'<div class="col-md-4">'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero1" id="iGenero1" '.validaGeneroS($campo['idSerie'],1).'>'
                                            .'<label for="iGenero1" class="form-label">&nbsp;Ação</label>'
                                        .'</div>'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero2" id="iGenero2" '.validaGeneroS($campo['idSerie'],2).'>'
                                            .'<label for="iGenero2" class="form-label">&nbsp;Aventura</label>'
                                        .'</div>'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero3" id="iGenero3" '.validaGeneroS($campo['idSerie'],3).'>'
                                            .'<label for="iGenero3" class="form-label">&nbsp;Anime</label>'
                                        .'</div>'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero4" id="iGenero4" '.validaGeneroS($campo['idSerie'],4).'>'
                                            .'<label for="iGenero4" class="form-label">&nbsp;Comédia</label>'
                                        .'</div>'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero5" id="iGenero5" '.validaGeneroS($campo['idSerie'],5).'>'
                                            .'<label for="iGenero5" class="form-label">&nbsp;Documentário</label>'
                                        .'</div>'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero6" id="iGenero6" '.validaGeneroS($campo['idSerie'],6).'>'
                                            .'<label for="iGenero6" class="form-label">&nbsp;Drama</label>'
                                        .'</div>'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero7" id="iGenero7" '.validaGeneroS($campo['idSerie'],7).'>'
                                            .'<label for="iGenero7" class="form-label">&nbsp;Fantasia</label>'
                                        .'</div>'
                                    .'</div>'   
                                    .'<div class="col-md-4">'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero8" id="iGenero8" '.validaGeneroS($campo['idSerie'],8).'>'
                                            .'<label for="iGenero8" class="form-label">&nbsp;Terror</label>'
                                        .'</div>'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero9" id="iGenero9" '.validaGeneroS($campo['idSerie'],9).'>'
                                            .'<label for="iGenero9" class="form-label">&nbsp;Infantil</label>'
                                        .'</div>'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero10" id="iGenero10" '.validaGeneroS($campo['idSerie'],10).'>'
                                            .'<label for="iGenero10" class="form-label">&nbsp;Suspense</label>'
                                        .'</div>'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero11" id="iGenero11" '.validaGeneroS($campo['idSerie'],11).'>'
                                            .'<label for="iGenero11" class="form-label">&nbsp;Mistério</label>'
                                        .'</div>'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero12" id="iGenero12" '.validaGeneroS($campo['idSerie'],12).'>'
                                            .'<label for="iGenero12" class="form-label">&nbsp;Romance</label>'
                                        .'</div>'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero13" id="iGenero13" '.validaGeneroS($campo['idSerie'],13).'>'
                                            .'<label for="iGenero13" class="form-label">&nbsp;Ficção Ciêntifica</label>'
                                        .'</div>'
                                    .'</div>'    
                                .'</div>'     
                            .'</div>'
                    
                            .'<div class="modal-footer">'
                                .'<a href="telaSeries.php" class="btn btn-danger" title="Cancelar a operação">'
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

function validaGeneroS($idSerie,$idGenero){
    $check = '';

    include('conexao.php');
    $sql = "SELECT * FROM generoseries "
            ." WHERE series_idSerie = ".$idSerie
            ." AND generos_idGenero = ".$idGenero.";"; 
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);

    if (mysqli_num_rows($result) > 0) {	

        $lista = array();
        
        while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            array_push($lista,$linha);
        }

        foreach ($lista as $campo) {
            $check = 'checked';
        }
    }
    
    return $check;
}


?>