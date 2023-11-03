<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class workerThread extends Thread {
    public function __construct($i){
        $this->i=$i;
    }

    public function run(){
        while(true){
            echo $this->i;
            sleep(1);
        }
    }
}

for($i=0;$i<50;$i++){
    $workers[$i]=new workerThread($i);
    $workers[$i]->start();
}
?>
