<?php

namespace App\Repository;

use App\Enties\Product\ProductEntite;
use App\Interfaces\ProductInterface;
use App\Models\Product;
use App\Utils\ResponseMessage;
use Exception;

class ProductRepository extends Product implements ProductInterface{


    public function productIndex($paginate)
    {
        $paginate ?  $paginate > 0 : $paginate = 5;
        $reponse = $this->paginate($paginate);
        return ResponseMessage::sucessMessage($reponse, ResponseMessage::$sucessGeneric);
    }

    public function getById($id)
    {
        $id ?  $id > 0 : $id = 0;
        $product = $this->find($id);
        
        if(!is_null($product)){
            $product->load('brand','category');
            return $product;
        } else {
            return ResponseMessage::errorMessage($product, ResponseMessage::$errorGeneric);
        }
    }

    public function validateProduct(array $product)
    {
        $response = ProductEntite::fromJsonProductEntidade($product);
        if(isset($response->valid)){
            $response = json_encode($response);
            throw new Exception($response, 406);
        } else {
            return true;
        }
    }

    public function storageProduct($request)
    {
        try {
            $product = $request->only($this->getModel()->getFillable());
            $valid   = $this->validateProduct($product);
            $response = $this->create($product);
            return $response;
            
        } catch (\Exception $e) {
            return ResponseMessage::errorMessage(false, $e->getMessage());
        }
    }
}
