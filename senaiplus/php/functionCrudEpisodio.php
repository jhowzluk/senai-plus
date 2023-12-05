<?php

function carregaEpisodios(){

    $html = '';

    include('conexao.php');
    $sql = "SELECT episodios.*, series.nome AS nome_serie FROM episodios "
        ."INNER JOIN series "
        ."ON episodios.series_idSerie = series.idSerie;";
    
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
                .'<td>'.$campo['idEpisodio'].'</td>'
                .'<td>'.$campo['nome'].'</td>'
                .'<td>'.$campo['nome_serie'].'</td>'
                .'<td>'.$campo['nrEpisodios'].'</td>'
                .'<td>'.$campo['temporada'].'</td>'
                .'<td>'.$campo['hora'].':'.$campo['minutos'].'</td>'
                .'<td>'.$campo['lancamento'].'</td>'
                .'<td align="center">'
                    .'<div class="row">'
                        .'<div class="col-md-12">'
                            .'<a href="#editarEpisodioModal'.$campo['idEpisodio'].'" id="edit" class="edit" data-toggle="modal">'
                                .'<h6><i class="fa fa-edit text-info" data-toggle="tooltip" title="Alterar informações"></i></h6>'
                            .'</a>'
                        .'</div>'
                    .'</div>'
                .'</td>'
            .'</tr>'

            .'<div class="modal fade" id="editarEpisodioModal'.$campo['idEpisodio'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'
                .'<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">'
                    .'<div class="modal-content">'
                        .'<div class="modal-header bg-info">'
                            .'<h4 class="modal-title" id="exampleModalLabel">Editar Episódio</h4>'
                            .'<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">'
                                .'<span aria-hidden="true">&times;</span>'
                            .'</button>'
                        .'</div>'
                        .'<form method="POST" action="php/salvaEpisodio.php?id='.$campo['idEpisodio'].'" enctype="multipart/form-data">'
                            .'<div class="modal-body">'
                                .'<div class="mb-3">'
                                    .'<label for="iNomeEpisodio" class="form-label">Nome</label>'
                                    .'<input type="text" class="form-control" name="nNomeEpisodio" id="iNomeEpisodio" value="'.$campo['nome'].'">'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iTemporadaEpisodio" class="form-label">N° Temporada</label>'
                                    .'<input class="form-control" type="number" name="nTemporadaEpisodio" id="iTemporadaEpisodio" value="'.$campo['temporada'].'">'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iNumeroEpisodio" class="form-label">N° Episódio</label>'
                                    .'<input class="form-control" type="number" name="nNumeroEpisodio" id="iNumeroEpisodio" value="'.$campo['nrEpisodios'].'">'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iVideoEpisodio" class="form-label">Vídeo do episódio</label>'
                                    .'<input class="form-control" type="file" name="nVideoEpisodio" id="iVideoEpisodio" accept="video/*" value="'.$campo['video'].'">'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iSinopseEpisodio" class="form-label">Sinopse</label>'
                                    .'<textarea class="form-control" name="nSinopseEpisodio" id="iSinopseEpisodio" rows="3" value="'.$campo['sinopse'].'">'.$campo['sinopse'].'</textarea>'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iLancamentoEpisodio" class="form-label">Data de lançamento</label>'
                                    .'<input type="date" class="form-control" name="nLancamentoEpisodio" id="iLancamentoEpisodio" value="'.$campo['lancamento'].'">'
                                .'</div>'
                                .'<br>'
                                .'<div class="mb-3">'
                                    .'<label class="form-label">Série:&nbsp;&nbsp;</label>'
                                    .listaSerie()
                                .'</div>'
                                .'<br>'
                                .'<div class="mb-3">'
                                    .'<label for="iTempoEpisodio" class="form-label">Duração</label>'
                                    .'<input type="time" class="form-control" name="nTempoEpisodio" id="iTempoEpisodio" value="'.'0'.$campo['hora'].':'.$campo['minutos'].'">'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iDiretorEpisodio" class="form-label">Diretor</label>'
                                    .'<input type="text" class="form-control" name="nDiretorEpisodio" id="iDiretorEpisodio" value="'.$campo['diretor'].'">'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iElencoEpisodio" class="form-label">Elenco</label>'
                                    .'<textarea class="form-control" name="nElencoEpisodio" id="iElencoEpisodio" rows="3" value="'.$campo['elenco'].'">'.$campo['elenco'].'</textarea>'
                                .'</div>'
                            .'</div>'
                            .'<div class="modal-footer">'
                                .'<a href="telaEpisodios.php" class="btn btn-danger" title="Cancelar a operação">'
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