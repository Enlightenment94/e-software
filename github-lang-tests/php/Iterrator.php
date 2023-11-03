<?php

class IntegerIterator implements Iterator {
    private $array;
    private $position = 0;

    public function __construct(array $array) {
        $this->array = $array;
    }

    public function rewind() {
        $this->position = 0;
    }

    public function current() {
        return $this->array[$this->position];
    }

    public function key() {
        return $this->position;
    }

    public function next() {
        $this->position++;
    }

    public function valid() {
        while(isset($this->array[$this->position])) {
            if(is_int($this->array[$this->position])) {
                return true;
            }
            $this->position++;
        }
        return false;
    }
}
?>