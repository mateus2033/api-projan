<?php

namespace App\Interfaces;

use App\Models\User;

interface PermissionInterface {

    public function getUser(array $data);
    public function validUser(User $user);
    public function validPermissionValue(array $data);
    public function setPermission(array $data);
    public function savePermissionUser(User $user);
}