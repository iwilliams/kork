<?php

class Board {

    private $id;
    private $title;
    private $description;
    private $children = array();

    /**
     * @param integer $idIn Unique ID of the board
     */
    public function __construct($idIn, $titleIn, $descriptionIn, $childrenIn = null) {
        $this -> id = $idIn;
        $this -> title = $titleIn;
        $this -> description = $descriptionIn;
        if (!empty($childrenIn)) {
            $this -> children = $childrenIn;
        }
    }

    /**
     * Need to override this method so that the children are also cloned. But Should
     * we be cloning boards or posts for that matter anyway? Maybe set the new ID and 
     * the posts ID to 0? For now set the cloned boards ID to 0, the post id will be 
     * set to 0 as well inside their own overridden clone method.
     */
    public function __clone() {
        $this -> id = 0;
        for ($i = 0; $i < count($this -> children); $i++) {
            $this -> children[$i] = clone $this -> children[$i];
        }
    }
    
    public function setId($idIn) {
        $this -> id = $idIn;
    }

    public function getId() {
        return $this -> id;
    }

    public function setTitle($titleIn) {
        $this -> title = $titleIn;
    }

    public function getTitle() {
        return $this -> title;
    }

    public function setDescription($descriptionIn) {
        $this -> description = $descriptionIn;
    }

    public function getDescription() {
        return $this -> description;
    }

    public function addChild($child) {
        $this -> addChildren(array($child));
    }

    public function addChildren($children) {
        $this -> children = array_unique(array_merge($this -> children, $children));
    }

    public function getChildren() {
        return $this -> children;
    }

}
?>

