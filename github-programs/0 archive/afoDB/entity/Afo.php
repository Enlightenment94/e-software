<?php
/*
    afo_id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    afo TEXT,
    author VARCHAR(128), 
    otxt TEXT,
    date VARCHAR(256)
*/
class Afo{
    private $afo_id;
    private $afo;
    private $author;
    private $otxt;
    private $date;

    public function __construct() {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();
        $this->afo_id = "";
        $this->afo = ""; 
        $this->author = ""; 
        $this->otxt = ""; 
        $this->date = "";

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }

    public function __construct5($afo_id, $afo, $author, $otxt, $date) {
        $this->afo_id = $afo_id;
        $this->afo = $afo; 
        $this->author = $author; 
        $this->otxt = $otxt; 
        $this->date = $date;
    }
    
    function getAfo_id(){
        return $this->afo_id;
    }

    function setAfo_id($afo_id){
        $this->afo_id = $afo_id;
    }

    function getAfo(){
        return $this->afo;
    }

    function setAfo($setAfo){
        $this->afo = $setAfo;
    }

    function getAuthor(){
        return $this->author;
    }

    function setAuthor($setAuthor){
        $this->author = $setAuthor;
    }

    function getOtxt(){
        return $this->otxt;
    }

    function setOtxt($otxt){
        $this->otxt = $otxt;
    }

    function getDate(){
        return $this->date;
    }

    function setDate($date){
        $this->date = $date;
    }  
}
?>
