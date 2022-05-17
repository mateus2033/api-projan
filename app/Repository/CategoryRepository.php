<?php

namespace App\Repository;

use App\Interfaces\CategoryInterface;
use App\Models\Category;
use App\Utils\ResponseMessage;
use Exception;

class CategoryRepository extends Category implements CategoryInterface {
    
    public function CategoryIndex($paginate)
    {
        $paginate ?  $paginate > 0 : $paginate = 5;
        $reponse = $this->paginate($paginate);
        return ResponseMessage::sucessMessage($reponse, ResponseMessage::$sucessGeneric);
    }

    public function getById($id)
    {
        $id ?  $id > 0 : $id = 0;
        $category = $this->find($id);
        
        if(!is_null($category)){
            return $category;
        } else {
            return ResponseMessage::errorMessage($category, ResponseMessage::$errorGeneric);
        }
    }

    public function validCategory(array $category)
    {   
        if(!isset($category['name']))
        {
            throw new Exception(ResponseMessage::$required, 400);
        }

        if(!is_string($category['name']))
        {
            throw new Exception(ResponseMessage::$mustBeString);
        }

        $result = $this->getModel()->where('name' , 'like', $category['name'])->first();     
        if($result)
        {
            throw new Exception(ResponseMessage::$categoryExist);
        }

        return $category;
    }

    public function storageCategory($data)
    {
        try {
            $category = $data->only($this->getModel()->getFillable());
            $category = $this->validCategory($category);
            $result   = $this->create($category);
            return $result;
        } catch (\Exception $e) {
            return ResponseMessage::errorMessage(false, $e->getMessage());
        }
    }
}