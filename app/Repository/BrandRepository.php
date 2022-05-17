<?php

namespace App\Repository;

use App\Interfaces\BrandInterface;
use App\Models\Brand;
use App\Utils\ResponseMessage;
use Exception;

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
            return ResponseMessage::errorMessage(false, ResponseMessage::$errorGeneric);
        }
    }

    public function validBrand(array $brand)
    {   
        if(!isset($brand['name']))
        {
            throw new Exception(ResponseMessage::$required, 400);
        }

        if(!is_string($brand['name']))
        {
            throw new Exception(ResponseMessage::$mustBeString);
        }

        $result = $this->getModel()->where('name' , 'like', $brand['name'])->first();     
        if($result)
        {
            throw new Exception(ResponseMessage::$brandExist);
        }

        return $brand;
    }

    public function storageBrand($data)
    {
        try {
            $brand = $data->only($this->getModel()->getFillable());
            $brand = $this->validBrand($brand);
            $result = $this->create($brand);
            return $result;
        } catch (\Exception $e) {
            return ResponseMessage::errorMessage(false, $e->getMessage());
        }
    }
}