<?php

namespace App\Interfaces;

interface CategoryInterface {

    public function CategoryIndex($request);
    public function getById($request);
    public function storageCategory($request);
    public function validCategory(array $category);
}