<?php

namespace App\Http\Controllers;

use App\Models\User as UserModel;
use App\Repository\PermissionRepository;
use Facade\FlareClient\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    protected $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function setPermission(Request $request)
    {
      
        $user = $this->userModel->me();
        if (!Gate::allows('admin', $user->original)) {
            return response()->json(['status' => 'User without authorization'], Response::HTTP_UNAUTHORIZED);
        } 

        $permissionRepository = new PermissionRepository();
        $permission = $permissionRepository->setPermission($request->all());

        if(!isset($permission['code']))
        {
            DB::commit();
            return response()->json($permission, Response::HTTP_OK);
        } else {
            DB::rollBack();
            return response()->json($permission, Response::HTTP_FORBIDDEN);
        }

    }

}
