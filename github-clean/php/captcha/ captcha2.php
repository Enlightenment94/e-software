<?php

function random(){
    $chars = '0123456789';
    $charsLength = 7;
    $str = '';
    
    for ($i = 0; $i < $charsLength; $i++)
        $str .= substr($chars, mt_rand(0, strlen($chars) -1), 1);
    
    return $str;
}

function captcha($str){
    $width = 170;       
    $height = 30;       
    
    $string = $str;

    $im = imagecreate($width, $height);
    
    //kolory obrazka
    $back     = imagecolorallocate($im,0,0,0);
    $font   = imagecolorallocate($im,255,255,255);
    $wipe   = imagecolorallocate($im,78,78,78);
    $border = imagecolorallocate ($im, 255, 0, 0);
    
    imagefill($im,1,1,$back);
    
    for($i=0; $i<1600; $i++)
    {
        $rand1 = rand(0,$width);
        $rand2 = rand(0,$height);
        imageline($im, $rand1, $rand2, $rand1, $rand2, $wipe);
    }
    
    $x = rand(5, $width/(7/2));
    
    imagerectangle($im, 0, 0, $width-1, $height-1, $border);
    
    for($a=0; $a < 7; $a++)
    {
        imagestring($im, 6, $x, rand(4 , $height/5), substr($string, $a, 1), $font);
        $x += (5*3);
    }
    
    imagegif($im);
    imagedestroy($im);
}

ob_start();
$str = random();
captcha($str);
$image = ob_get_contents();
$data = base64_encode($image);
ob_clean();

echo "<h1> hello </h1>";
echo "<img src='data:image/png;base64," . $data . "'/>";
?>


