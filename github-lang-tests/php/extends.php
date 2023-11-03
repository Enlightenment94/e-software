<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class MyObject{
  private $prv;
  public $pub = "publicStr";
  protected $pro = "3";
  private $varriable;

  function __construct() { 
     $this->prv = 'test';
     $a = func_get_args(); 
     $i = func_num_args(); 
     if (method_exists($this, $f='__construct'.$i)) { 
            call_user_func_array(array($this, $f), $a); 
     } 
  }

  public function __construct1($arg) {
    $this->varriable = $arg;
  }

  public function __construct2($arg1, $arg2) {
    $this->prv = $arg1;
    $this->varriable = $arg2;
  }
  
  public function getPrv(){
    return $this->prv;
  }

  public function getVarriable(){
    return $this->varriable;
  }

  private function notExtends(){
    echo "Not extends !!!";
  }
}

class MyChildObject extends MyObject{

}


$o = new MyObject("abc","123");
echo "Public: " . $o->pub . "</br>";
try{
    //echo "Protected: " . $o->pro . "</br>";
/*
Fatal error: Uncaught Error: Cannot access protected property MyObject::$pro in /opt/lampp/htdocs/dspace/elight/www/enlightenment/2 IT/github-lang-tests/php/extends.php:51 Stack trace: #0 {main} thrown in /opt/lampp/htdocs/dspace/elight/www/enlightenment/2 IT/github-lang-tests/php/extends.php on line 51
*/
}catch (Exception $e){
    echo "Protected not be access by ->: </br>";
}

try{
    //echo "Private: " . $o->prv . "</br>";
/*
Fatal error: Uncaught Error: Cannot access private property MyObject::$prv in /opt/lampp/htdocs/dspace/elight/www/enlightenment/2 IT/github-lang-tests/php/extends.php:57 Stack trace: #0 {main} thrown in /opt/lampp/htdocs/dspace/elight/www/enlightenment/2 IT/github-lang-tests/php/extends.php on line 57
*/
}catch (Exception $e){
    throw new Exception("Private not acces by ->");
    echo "Private not acces by ->";
    echo "Private only by funciton: " . $o->getPrv() . "</br>";
}

$o = new MyChildObject("abc","123");
//error tags

//echo "Extends public varriable: YES " . $o->varriable;
//echo "Extends protected varrible: ??? " . $o->pro;
//echo "Extends private function: NOT " . $o->notExtends();

//Wniosek: protected to private, ale z dziedziczeniem.
?>
