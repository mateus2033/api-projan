<?php

namespace App\Repository;

use App\Interfaces\CategoryInterface;
use App\Models\Category;
use App\Utils\ResponseMessage;

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

    public function storageCategory($request)
    {
        //
    }
}