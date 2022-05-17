<?php

namespace App\Enties\Product;

use App\Utils\ResponseMessage;
use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;

/**
 * @property string  $name
 * @property numeric $price
 * @property data  $validate
 * @property int   $brand_id
 * @property int   $category_id
 * @property string[] $message
 * @property bool     $valid;
*/
class ProductEntite {


    public static function fromJsonProductEntidade($data)
    {   
        $self = new self();
        $self->validarAluno(collect($data));
        if($self->valid == false){
            return $self;
        } else {
            return true;
        }
    }

    public function validarAluno($data)
    {
        $array = [];
        $array['name']       = $this->_name($data);
        $array['price']      = $this->_price($data);
        $array['validate']   = $this->_validate($data);
        $array['brand_id']   = $this->_brand_id($data);
        $array['category_id']= $this->_category_id($data);
      
        $array =  array_filter($array, function($data)
        {
            return $data != null;
        });

        $state = !empty($array);
        if($state)
        {
            $this->message = $array;
            $this->valid    = false;
        } else { 
            $this->message = [];
            $this->valid    = true;
        }
    }

    /**
    * Valid field name
    */
    private function _name($data)
    {
        if(!isset($data['name']))
        {
            return ResponseMessage::$required;
        }

        if(!is_string($data['name']))
        {
            return ResponseMessage::$mustBeString;
        }

        return null;
    }

    /**
    * Valid field price
    */
    private function _price($data)
    {
        if(!isset($data['price']))
        {
            return ResponseMessage::$required;
        }

        if(!is_numeric($data['price']))
        {
            return ResponseMessage::$mustNumeric;
        }

        return null;
        
    }

    /**
    * Valid field validate
    */
    private function _validate($data)
    {
        if(!isset($data['validate']))
        {
            return ResponseMessage::$required;
        }

        if(!is_string($data['validate']))
        {
            return ResponseMessage::$mustBeString;
        }

        return null;
    
    }

    /**
    * Valid field brand_id
    */
    private function _brand_id($data)
    {
        if(!isset($data['brand_id']))
        {
            return null;
        }

        if(!is_integer($data['brand_id']))
        {
            return ResponseMessage::$mustBeInteger;
        }
        
        $brand = new BrandRepository();
        if(!$brand->getById($data['brand_id']) instanceof BrandRepository){
            return ResponseMessage::$notExistBrand;
        }   
        
        return null;
        
    }

    /**
    * Valid field category_id
    */
    private function _category_id($data)
    {
        if(!isset($data['category_id']))
        {
            return null;
        }

        if(!is_integer($data['category_id']))
        {
            return ResponseMessage::$mustBeInteger;
        }

        $category =  new CategoryRepository();
        if(!$category->getById($data['category_id']) instanceof CategoryRepository){
            return ResponseMessage::$notExistCategory;
        }  
        
        return null;
    }
}