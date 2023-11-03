<?php
function captcha(){
    $szerokosc = 170;       // szerokość obrazka
    $wysokosc = 30;         // wysokość obrazka
    $znaki = '0123456789';  // dozwolone znaki
    $ilosc_znakow = 6;      // długość captchy
    $str = '';              // zmienna pomocnicza
    
    // losowanie ciągu znkaów
    for ($i = 0; $i < $ilosc_znakow; $i++)
        $str .= substr($znaki, mt_rand(0, strlen($znaki) -1), 1);
    
    $string = $str;
    
    // tworzenie obrazka o danych wymiarach
    $im = imagecreate($szerokosc, $wysokosc);
    
    //kolory obrazka
    $tlo     = imagecolorallocate($im,0,0,0);
    $czcionka   = imagecolorallocate($im,255,255,255);
    $siatka   = imagecolorallocate($im,78,78,78);
    $ramka = imagecolorallocate ($im, 255, 0, 0);
    
    imagefill($im,1,1,$tlo); // wypełnienie tłem
    
    // losowanie siatki
    for($i=0; $i<1600; $i++)
    {
        $rand1 = rand(0,$szerokosc);
        $rand2 = rand(0,$wysokosc);
        imageline($im, $rand1, $rand2, $rand1, $rand2, $siatka);
    }
    
    // losowanie pozycji znaków
    $x = rand(5, $szerokosc/(7/2));
    
    // dodawanie obramowania
    imagerectangle($im, 0, 0, $szerokosc-1, $wysokosc-1, $ramka);
    
    // umieszczanie liter na obrazku
    for($a=0; $a < 7; $a++)
    {
        imagestring($im, 6, $x, rand(4 , $wysokosc/5), substr($string, $a, 1), $czcionka);
        $x += (5*3); // odstęp między literami
    }
    
    // zwrócenie wygenerowanego obrazka, ustawienie typu mime na GIF
    //header("Content-type: image/gif");
    imagegif($im);
    imagedestroy($im);
}

ob_start();
captcha();
$image = ob_get_contents();
$data = base64_encode($image);
ob_clean();

echo "<h1> hello </h1>";
echo "<img src='data:image/png;base64," . $data . "'/>";
?>


