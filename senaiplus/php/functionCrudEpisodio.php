<?php

function carregaEpisodios(){

    $html = '';

    include('conexao.php');
    $sql = "SELECT * FROM episodios;"; 
    
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
                .'<td>'.$campo['lancamento'].'</td>'
                .'<td>'.$campo['hora'].':'.$campo['minuto'].'</td>'
                .'<td>'.$campo['estudio'].'</td>'
                .'<td>'.$campo['diretor'].'</td>'
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
                                    .'<label for="iVideoEpisodio" class="form-label">Vídeo do episódio</label>'
                                    .'<input class="form-control" type="file" name="nVideoEpisodio" id="iVideoEpisodio" accept="video/*" value="'.$campo['video'].'">'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iCapaEpisodio" class="form-label">Imagem da capa</label>'
                                    .'<input class="form-control" type="file" name="nCapaEpisodio" id="iCapaEpisodio" accept="image/*" value="'.$campo['capa'].'">'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iCarouselEpisodio" class="form-label">Imagem do carousel</label>'
                                    .'<input class="form-control" type="file" name="nCarouselEpisodio" id="iCarouselEpisodio" accept="image/*" value="'.$campo['carouselimage'].'">'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iSinopseEpisodio" class="form-label">Sinopse</label>'
                                    .'<textarea class="form-control" name="nSinopseEpisodio" id="iSinopseEpisodio" rows="3" value="'.$campo['sinopse'].'">'.$campo['sinopse'].'</textarea>'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iLancamentoEpisodio" class="form-label">Data de lançamento</label>'
                                    .'<input type="date" class="form-control" name="nLancamentoEpisodio" id="iLancamentoEpisodio" value="'.$campo['lancamento'].'">'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iTempoEpisodio" class="form-label">Duração</label>'
                                    .'<input type="time" class="form-control" name="nTempoEpisodio" id="iTempoEpisodio" value="'.'0'.$campo['hora'].':'.$campo['minuto'].'">'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iEstudioEpisodio" class="form-label">Estúdio</label>'
                                    .'<input type="text" class="form-control" name="nEstudioEpisodio" id="iEstudioEpisodio" value="'.$campo['estudio'].'">'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iDiretorEpisodio" class="form-label">Diretor</label>'
                                    .'<input type="text" class="form-control" name="nDiretorEpisodio" id="iDiretorEpisodio" value="'.$campo['diretor'].'">'
                                .'</div>'
                                .'<div class="mb-3">'
                                    .'<label for="iElencoEpisodio" class="form-label">Elenco</label>'
                                    .'<textarea class="form-control" name="nElencoEpisodio" id="iElencoEpisodio" rows="3" value="'.$campo['elenco'].'">'.$campo['elenco'].'</textarea>'
                                .'</div>' 
                                .'<br>'
                                .'<div class="mb-3">'
                                    .'<label class="form-label">Classificação indicativa:&nbsp;&nbsp;</label>'
                                    .listaClassificacao("f")
                                .'</div>'
                                .'<br>'
                                .'<div class="row">'
                                    .'<div class="col-md-4">'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero1" id="iGenero1" '.validaGeneroF($campo['idEpisodio'],1).'>'
                                            .'<label for="iGenero1" class="form-label">&nbsp;Ação</label>'
                                        .'</div>'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero2" id="iGenero2" '.validaGeneroF($campo['idEpisodio'],2).'>'
                                            .'<label for="iGenero2" class="form-label">&nbsp;Aventura</label>'
                                        .'</div>'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero3" id="iGenero3" '.validaGeneroF($campo['idEpisodio'],3).'>'
                                            .'<label for="iGenero3" class="form-label">&nbsp;Anime</label>'
                                        .'</div>'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero4" id="iGenero4" '.validaGeneroF($campo['idEpisodio'],4).'>'
                                            .'<label for="iGenero4" class="form-label">&nbsp;Comédia</label>'
                                        .'</div>'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero5" id="iGenero5" '.validaGeneroF($campo['idEpisodio'],5).'>'
                                            .'<label for="iGenero5" class="form-label">&nbsp;Documentário</label>'
                                        .'</div>'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero6" id="iGenero6" '.validaGeneroF($campo['idEpisodio'],6).'>'
                                            .'<label for="iGenero6" class="form-label">&nbsp;Drama</label>'
                                        .'</div>'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero7" id="iGenero7" '.validaGeneroF($campo['idEpisodio'],7).'>'
                                            .'<label for="iGenero7" class="form-label">&nbsp;Fantasia</label>'
                                        .'</div>'
                                    .'</div>'   
                                    .'<div class="col-md-4">'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero8" id="iGenero8" '.validaGeneroF($campo['idEpisodio'],8).'>'
                                            .'<label for="iGenero8" class="form-label">&nbsp;Terror</label>'
                                        .'</div>'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero9" id="iGenero9" '.validaGeneroF($campo['idEpisodio'],9).'>'
                                            .'<label for="iGenero9" class="form-label">&nbsp;Infantil</label>'
                                        .'</div>'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero10" id="iGenero10" '.validaGeneroF($campo['idEpisodio'],10).'>'
                                            .'<label for="iGenero10" class="form-label">&nbsp;Suspense</label>'
                                        .'</div>'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero11" id="iGenero11" '.validaGeneroF($campo['idEpisodio'],11).'>'
                                            .'<label for="iGenero11" class="form-label">&nbsp;Mistério</label>'
                                        .'</div>'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero12" id="iGenero12" '.validaGeneroF($campo['idEpisodio'],12).'>'
                                            .'<label for="iGenero12" class="form-label">&nbsp;Romance</label>'
                                        .'</div>'
                                        .'<div class="mb-3">'
                                            .'<input type="checkbox" name="nGenero13" id="iGenero13" '.validaGeneroF($campo['idEpisodio'],13).'>'
                                            .'<label for="iGenero13" class="form-label">&nbsp;Ficção Ciêntifica</label>'
                                        .'</div>'
                                    .'</div>'    
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