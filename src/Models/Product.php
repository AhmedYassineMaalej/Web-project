<?php

namespace App\Models;

class Product {
    public int $id;
    public string $name;
    public string $reference;
    public string $description;
    public string $image;
    public Category $category;
    public array $info;

    public function __construct(int $id, string $name, string $reference, string $description, string $image, Category $category, array $info) {
        $this->id = $id;
        $this->name = $name;
        $this->reference = $reference;
        $this->description = $description;
        $this->image = $image;
        $this->category = $category;
        $this->info = $info;
    }
}
