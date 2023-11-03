<?php
class Record{
    private $note_id; 
    private $title;
    private $text;
    private $date;
    private $sort_nr;

    public function __construct() {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();
        $this->note_id = ""; 
        $this->title = "";
        $this->text = "";
        $this->date = "";
        $this->sort_nr = "";

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }

    public function __construct5($note_id, $title, $text, $date, $sort_nr) {
        $this->note_id = $note_id; 
        $this->title = $title;
        $this->text = $text;
        $this->date = $date;
        $this->sort_nr = $sort_nr;
    }
    
    function getNote_id(){
        return $this->note_id;
    }

    function getTitle(){
        return $this->title;
    }

    function getText(){
        return $this->text;
    }

    function getDate(){
        return $this->date;
    }
    function getSort_nr(){
        return $this->sort_nr;
    }

    function setNote_id($note_id){
        $this->note_id = $note_id;
    }

    function setTitle($title){
        $this->title = $title;
    }

    function setText($text){
        $this->text = $text;
    }

    function setDate($date){
        $this->date = $date;
    }

    function setSort_nr($sort_nr){
        $this->sort_nr = $sort_nr;
    }
}
?>
