<?php
class Book {
    public $id;  
    public $title;
    public $author;
    public $price;
    public $pubyear;

    
    public function __construct($title = '', $author = '', $price = 0, $pubyear = 0) {
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
        $this->pubyear = $pubyear;
    }
}

?>

