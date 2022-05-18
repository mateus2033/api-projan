<?php

namespace App\Enties\Permission;

use App\Utils\ResponseMessage;

/**
 * @property bool $product_permission
 * @property bool $brand_permission
 * @property bool $category_permission
 * @property int  $user_id
 * @property string[] $message
 * @property bool  $valid;
 */
class PermissionEntity
{

    public static function fromJsonProductEntidade($data)
    {
        $self = new self();
        $self->validarPermission($data);
        if ($self->valid == false) {
            return $self;
        } else {
            return true;
        }
    }

    public function validarPermission($data)
    {
        $array = [];
        $array['product_permission']  = $this->_product_permission($data);
        $array['brand_permission']    = $this->_brand_permission($data);
        $array['category_permission'] = $this->_category_permission($data);
        $array['user_id']  = $this->_user_id($data);

        $array =  array_filter($array, function ($data) {
            return $data != null;
        });

        $state = !empty($array);
        if ($state) {
            $this->message = $array;
            $this->valid    = false;
        } else {
            $this->message = [];
            $this->valid    = true;
        }
    }

    private function _product_permission($data)
    {   
        if (!isset($data['product_permission'])) {
            return null;
        }

        if($data['product_permission'] != 1 && $data['product_permission'] != 0)
        {
            return ResponseMessage::$mustValueBool;
        }

        return null;
    }

    private function _brand_permission($data)
    {
        if (!isset($data['brand_permission'])) {
            return null;
        }

        if($data['brand_permission'] != 1 && $data['brand_permission'] != 0)
        {
            return ResponseMessage::$mustValueBool;
        }

        return null;
    }

    private function _category_permission($data)
    {
        if (!isset($data['category_permission'])) {
            return null;
        }

        if($data['category_permission'] != 1 && $data['category_permission'] != 0)
        {
            return ResponseMessage::$mustValueBool;
        }

        return null;
    }

    private function _user_id($data)
    {
        if (!isset($data['user_id'])) {
            return ResponseMessage::$required;
        }

        if (!is_integer($data['user_id'])) {
            return ResponseMessage::$mustBeInteger;
        }

        return null;
    }
}
