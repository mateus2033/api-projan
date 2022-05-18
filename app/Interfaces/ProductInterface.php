<?php

namespace App\Interfaces;

interface ProductInterface {

    public function productIndex($request);
    public function getById($request);
    public function storageProduct($request);
    public function validateProduct(array $product);
}