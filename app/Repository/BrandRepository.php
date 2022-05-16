<?php

namespace App\Repository;

use App\Interfaces\BrandInterface;
use App\Models\Brand;
use App\Utils\ResponseMessage;

class BrandRepository extends Brand implements BrandInterface {

    public function brandIndex($paginate)
    {
        $paginate ?  $paginate > 0 : $paginate = 5;
        $reponse = $this->paginate($paginate);
        return ResponseMessage::sucessMessage($reponse, ResponseMessage::$sucessGeneric);
    }

    public function getById($id)
    {
        $id ?  $id > 0 : $id = 0;
        $brand = $this->find($id);
        
        if(!is_null($brand)){
            return $brand;
        } else {
            return ResponseMessage::errorMessage($brand, ResponseMessage::$errorGeneric);
        }
    }

    public function storageBrand($request)
    {
        //
    }
}