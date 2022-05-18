<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Repository\BrandRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Gate;

class BrandController extends Controller
{
    protected $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function index(Request $request)
    {
        $user = $this->userModel->me();
        if (!Gate::allows(['user','brand'], $user->original)) {
            return response()->json(['status' => 'User without authorization'], Response::HTTP_UNAUTHORIZED);
        }

        $brandRepository = new BrandRepository();
        $response = $brandRepository->brandIndex($request->paginate);
        return response()->json($response, Response::HTTP_OK);
    }

    public function getById(Request $request)
    {
        $user = $this->userModel->me();
        if (!Gate::allows(['user','brand'], $user->original)) {
            return response()->json(['status' => 'User without authorization'], Response::HTTP_UNAUTHORIZED);
        }

        $brandRepository = new BrandRepository();
        $response = $brandRepository->getById($request->id);
        return response()->json(new BrandResource($response),Response::HTTP_OK);
    }

    public function storage(Request $request)
    {
        $user = $this->userModel->me();
        if (!Gate::allows(['user','brand'], $user->original)) {
            return response()->json(['status' => 'User without authorization'], Response::HTTP_UNAUTHORIZED);
        }

        $brandRepository = new BrandRepository();
        $reponse = $brandRepository->storageBrand($request);
        if(!isset($reponse['code'])){
            DB::commit();
            return response()->json(new BrandResource($reponse),Response::HTTP_OK);
        } else {
            DB::rollBack();
            return response()->json($reponse, Response::HTTP_BAD_REQUEST);
        }
    } 
}
