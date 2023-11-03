<?php

function captcha($str, $savePath){
    $width = 170;       
    $height = 30;       
    
    $string = $str;

    $im = imagecreate($width, $height);
    
    //kolory obrazka
    $back   = imagecolorallocate($im,0,0,0);
    $font   = imagecolorallocate($im,255,255,255);
    $wipe   = imagecolorallocate($im,78,78,78);
    $border = imagecolorallocate ($im, 0, 0, 0);
    
    imagefill($im,1,1,$back);
    
    for($i=0; $i<1600; $i++){
        $rand1 = rand(0,$width);
        $rand2 = rand(0,$height);
        imageline($im, $rand1, $rand2, $rand1, $rand2, $wipe);
    }
    
    //$x = round(rand(5, $width/(7/2)));
    $x = round(rand(5, ceil($width/7)*2));

    imagerectangle($im, 0, 0, $width-1, $height-1, $border);
    
    for($a=0; $a < 7; $a++){
        $r = rand(0,255);
        $g = rand(0,255);
        $b = rand(0,255);
        $font_color = imagecolorallocate($im, $r, $g, $b);
        imagestring($im, 6, $x, rand(4, $height/5), substr($string, $a, 1), $font_color);
        //imagestring($im, 6, $x, rand(4 , $height/5), substr($string, $a, 1), $font);
        $x += (5*3);
    }
    
    imagepng($im, $savePath); // zapisanie obrazka jako plik graficzny
    imagedestroy($im);
}

?>