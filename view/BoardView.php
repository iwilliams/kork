<?php

class BoardView {

    protected $board;
    protected $children; // Should this be like this?

    public function __construct($boardIn) {
        $this -> board = $boardIn;
        $tempChildren = $this -> board -> getChildren();
        if (!empty($tempChildren)) {
            $this -> children = $tempChildren;
        }
    }

    public function __toString() {
        $returnString = '';
        $returnString .= '<div class="board" id="b' . $this -> board -> getId() . '">';
        $returnString .= '<h1>' . $this -> board -> getTitle() . '</h1>';
        $returnString .= '<p>' . $this -> board -> getDescription() . '</p>';
        if (!empty($this -> children)) {
            foreach ($this -> children as $child) {
                $returnString .= '<div class="post" id="p' . $child -> getId() . '">';
                $returnString .= '<h2>' . $child -> getTitle() . '</h2>';
                $returnString .= '<h3>Author: ' . $child -> getAuthor() . '</h3>';
                $returnString .= '<p>' . $child -> getContent() . '</p>';
                $returnString .= '</div>';
            }
        }
        $returnString .= "</div>";
        return $returnString;
    }
    
    public function getBoard() {
        return $this -> board;
    }

    public function getChildren() {
        return $this -> children;
    }
}
?>