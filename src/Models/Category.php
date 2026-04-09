<?php

namespace App\Models;

class Category {
    public $ID;
    public $Name;

    public function __construct($id,$name) {
        $this->Name=$name;
        $this->ID = $id;
    }
}
