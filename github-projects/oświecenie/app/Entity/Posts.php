<?php

class Post {
    private $id;
    private $title;
    private $subtitle;
    private $description;

    public function __construct($title, $subtitle = null, $description = null) {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->description = $description;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getSubtitle() {
        return $this->subtitle;
    }

    public function getDescription() {
        return $this->description;
    }
}