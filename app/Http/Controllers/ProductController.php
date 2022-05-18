<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\User as UserModel;

class ProductController extends Controller
{
    protected $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function index(Request $request)
    { 
        $user = $this->userModel->me();

        if (!Gate::allows(['user','product'], $user->original)) {
            return response()->json(['status' => 'User without authorization'], Response::HTTP_UNAUTHORIZED);
        }   

        $productRepository = new ProductRepository();
        $reponse = $productRepository->productIndex($request->paginate);
        return response()->json($reponse, Response::HTTP_OK);
    }

    public function getById(Request $request)
    {   
        $user = $this->userModel->me();

        if (!Gate::allows(['user','product'], $user->original)) {
            return response()->json(['status' => 'User without authorization'], Response::HTTP_UNAUTHORIZED);
        }

        $productRepository = new ProductRepository();
        $reponse = $productRepository->getById($request->id);
        return response()->json(new ProductResource($reponse),Response::HTTP_OK);
    }

    public function storage(Request $request)
    {
        $user = $this->userModel->me();

        if (!Gate::allows(['user','product'], $user->original)) {
            return response()->json(['status' => 'User without authorization'], Response::HTTP_UNAUTHORIZED);
        }

        $productRepository = new ProductRepository();
        $reponse = $productRepository->storageProduct($request);
        
        if(!isset($reponse['code'])){
            DB::commit();
            return response()->json(new ProductResource($reponse),Response::HTTP_OK);
        } else {
            DB::rollBack();
            return response()->json($reponse, Response::HTTP_BAD_REQUEST);
        }
    } 

}
