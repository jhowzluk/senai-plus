<?php
    //retornar listagem de carousel
    function Carousel(){
        $carousel = "<div id='carouselExampleCaptions' class='carousel slide' data-bs-ride='carousel'>"
                    ."<div class='carousel-indicators '>"
                        ."<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='0' class='active' aria-current='true' aria-label='Slide 1'></button>"
                        ."<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='1' aria-label='Slide 2'></button>"
                        ."<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='2' aria-label='Slide 3'></button>"
                        ."<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='3' aria-label='Slide 4'></button>"
                        ."<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='4' aria-label='Slide 5'></button>"
                        ."<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='5' aria-label='Slide 6'></button>"
                        ."<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='6' aria-label='Slide 7'></button>"
                        ."<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='7' aria-label='Slide 8'></button>"
                        ."<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='8' aria-label='Slide 9'></button>"
                        ."<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='9' aria-label='Slide 10'></button>"
                    ."</div>"
                    ."<div class='carousel-inner '>";


        include('conexao.php');
        $sql = "Select * from filmes;";

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

        if(mysqli_num_rows($result) > 0){
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);
            }
            $count = 0;
            foreach($array as $campo){
                $count = $count + 1;
                if($count == 1){
                    $carousel .= "<div class='carousel-item active ' >"
                                    ."<img src='".$campo['carouselimage']."' height='500px' class='d-block w-100 op-50' alt='...'>"
                                    ."<div class='carousel-caption d-none d-md-block'>"
                                        ."<h5>".$campo['nome']."</h5>"
                                        ."<p>".$campo['sinopse']."</p>"
                                    ."</div>"
                            ."</div>";
                }else{
                    $carousel .= "<div class='carousel-item' >"
                                    ."<img src='".$campo['carouselimage']."' height='500px' class='d-block w-100 op-50' alt='...'>"
                                    ."<div class='carousel-caption d-none d-md-block'>"
                                        ."<h5>".$campo['nome']."</h5>"
                                        ."<p>".$campo['sinopse']."</p>"
                                    ."</div>"
                            ."</div>";
                }                        
            }
            
        }
        $carousel .= "<button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide='prev'>"
                        ."<span class='carousel-control-prev-icon' aria-hidden='true'></span>"
                        ."<span class='visually-hidden'>Previous</span>"
                    ."</button>"
                    ."<button class='carousel-control-next' type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide='next'>"
                        ."<span class='carousel-control-next-icon' aria-hidden='true'></span>"
                        ."<span class='visually-hidden'>Next</span>"
                    ."</button>"
                 ."</div>"
                 ."</div>";
        return $carousel;   
    }
