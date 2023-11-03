<?php
class User{
    private $user_id;
    private $login; 

    public function __construct() {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();
        $this->user_id = "";
        $this->login = ""; 

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }

    public function __construct2($user_id, $login) {
        $this->user_id = $user_id;
        $this->login = $login; 
    }

    function getUser_id(){
        return $this->user_id;
    }

    function setUser_id($user_id){
        $this->user_id = $user_id;
    }

    function getLogin(){
        return $this->login;
    }

    function setLogin($login){
        $this->login = $login;
    }
}
?>
