<?php
function captcha(){
    $width = 170;       // szerokość obrazka
    $height = 30;         // wysokość obrazka
    $chars = '0123456789';  // dozwolone znaki
    $charsLength = 7;      // długość captchy
    $str = '';              // zmienna pomocnicza
    
    // losowanie ciągu znkaów
    for ($i = 0; $i < $charsLength; $i++)
        $str .= substr($chars, mt_rand(0, strlen($chars) -1), 1);
    
    $string = $str;
    
    // tworzenie obrazka o danych wymiarach
    $im = imagecreate($width, $height);
    
    //kolory obrazka
    $back     = imagecolorallocate($im,0,0,0);
    $font   = imagecolorallocate($im,255,255,255);
    $wipe   = imagecolorallocate($im,78,78,78);
    $border = imagecolorallocate ($im, 255, 0, 0);
    
    imagefill($im,1,1,$back); // wypełnienie tłem
    
    // losowanie siatki
    for($i=0; $i<1600; $i++)
    {
        $rand1 = rand(0,$width);
        $rand2 = rand(0,$height);
        imageline($im, $rand1, $rand2, $rand1, $rand2, $wipe);
    }
    
    // losowanie pozycji znaków
    $x = rand(5, $width/(7/2));
    
    // dodawanie obramowania
    imagerectangle($im, 0, 0, $width-1, $height-1, $border);
    
    // umieszczanie liter na obrazku
    for($a=0; $a < 7; $a++)
    {
        imagestring($im, 6, $x, rand(4 , $height/5), substr($string, $a, 1), $font);
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


