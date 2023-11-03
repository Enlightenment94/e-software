<?php

class PostTag {
    private $postId;
    private $tagId;

    public function __construct($postId, $tagId) {
        $this->postId = $postId;
        $this->tagId = $tagId;
    }

    public function getPostId() {
        return $this->postId;
    }

    public function getTagId() {
        return $this->tagId;
    }
}