<?php

class Post {
        
    private $id;
    private $title;
    private $author;
    private $content;

    /**
     * @param int $idIn Id of the post. Set to 0 if creating a new post that does not already exist.
     */
    public function __construct($idIn, $titleIn, $authorIn, $contentIn = null) {
        $this -> id = $idIn;
        $this -> title = $titleIn;
        $this -> author = $authorIn;
        if (!empty($contentIn)) {
            $this -> content = $contentIn;
        }
    }
    
    /*
     * Set the cloned id to 0.
     */
    public function __clone(){
        $this -> id = 0;
    }

    public function getId() {
        return $this -> id;
    }

    public function getTitle() {
        return $this -> title;
    }

    public function getAuthor() {
        return $this -> author;
    }

    public function getContent() {
        return $this -> content;
    }

    public function setId($idIn) {
        $this -> id = $idIn;
    }

    public function setTitle($titleIn) {
        $this -> title = $titleIn;
    }

    public function setAuthor($authorIn) {
        $this -> author = $authorIn;
    }

    public function setContent($contentIn) {
        $this -> content = $contentIn;
    }

    public function __toString() {
        return $this -> id;
    }

}
?>