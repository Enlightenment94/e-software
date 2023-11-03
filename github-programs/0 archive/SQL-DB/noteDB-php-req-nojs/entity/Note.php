<?php
/*
    afo_id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    afo TEXT,
    author VARCHAR(128), 
    otxt TEXT,
    date VARCHAR(256)
*/
class Note{
    private $note_id;
    private $note;
    private $author;
    private $otxt;
    private $date;

    public function __construct() {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();
        $this->note_id = "";
        $this->note = ""; 
        $this->author = ""; 
        $this->otxt = ""; 
        $this->date = "";

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }

    public function __construct5($note_id, $note, $author, $otxt, $date) {
        $this->note_id = $note_id;
        $this->note = $note; 
        $this->author = $author; 
        $this->otxt = $otxt; 
        $this->date = $date;
    }
    
    function getNote_id(){
        return $this->note_id;
    }

    function setNote_id($note_id){
        $this->note_id = $note_id;
    }

    function getNote(){
        return $this->note;
    }

    function setNote($setNote){
        $this->note = $setNote;
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
