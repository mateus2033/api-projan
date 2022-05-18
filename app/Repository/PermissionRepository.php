<?php

namespace App\Repository;

use App\Enties\Permission\PermissionEntity;
use App\Interfaces\PermissionInterface;
use App\Models\Permission;
use App\Models\User;
use App\Utils\ResponseMessage;
use Exception;
use Illuminate\Http\Response;

class PermissionRepository extends Permission implements PermissionInterface
{
    
    public function getUser(array $data)
    {
        if (!$data['user_id']) {
            throw new Exception(ResponseMessage::$required, Response::HTTP_NOT_FOUND);
        }

        $user = User::find($data['user_id']);
        if (empty($user)) {
            throw new Exception(ResponseMessage::$userNotUser, Response::HTTP_NOT_FOUND);
        }

        return $user;
    }

    public function validUser(User $user)
    {

        if ($user->type_user === "admin") {
            throw new Exception(ResponseMessage::$notAuthorizate, Response::HTTP_UNAUTHORIZED);
        }

        if ($user->load('permission')) {
            return $user->permission;
        }

        throw new Exception(ResponseMessage::$permissionNotFound);
    }

    public function validPermissionValue(array $data)
    {
        $permission = PermissionEntity::fromJsonProductEntidade($data);
        if(isset($permission->message)){
            $result = json_encode($permission->message);
            throw new Exception($result, Response::HTTP_NOT_ACCEPTABLE);
        }
        return true;
    }

    public function setPermission(array $data)
    {
        try {
            $this->validPermissionValue($data);
            $user = $this->getUser($data);
            $permission = $this->validUser($user);
            $permission->update($data);
            return ResponseMessage::sucessMessage(true, ResponseMessage::$sucessGeneric);
        } catch (\Throwable $e) {
            return ResponseMessage::errorMessage(false, $e->getMessage());
        }
    }

    public function savePermissionUser(User $user)
    {
        if ($user->type_user === 'user') {
            $permission = array(
                'product_permission'  => 1,
                'brand_permission'    => 0,
                'category_permission' => 0,
                'user_id' => $user->id
            );

            $this->create($permission);
            return true;
        } else {
            return false;
        }
    }
}
