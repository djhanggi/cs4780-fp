<?php

require_once "Loader.php";

class Term {
    
    /** @var String */
    public $name;
    
    /** @var float */
    public $frequency;

    /** @var float */
    public $weight;

    public function __construct($term_array) {
        $this->name = $term_array['name'];
        $this->frequency = $term_array['frequency'];
        $this->weight = $term_array['weight'];
    }

    public function arrayifyThis() {
        return (array) $this;
    }

}