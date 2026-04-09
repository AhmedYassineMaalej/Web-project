<?php

namespace App\Entities;
class Provider {
    public $ID;
    public $Name;

    public function __construct($id,$name) {
        $this->ID = $id;
        $this->Name = $name;
    }
}
