<?php

namespace App\Interfaces;

interface BrandInterface {
    
    public function brandIndex($request);
    public function getById($request);
    public function storageBrand($request);

}