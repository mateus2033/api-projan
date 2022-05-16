<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Repository\ProductRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
     
    public function index(Request $request)
    {   
        $productRepository = new ProductRepository();
        $reponse = $productRepository->productIndex($request->paginate);
        return response()->json($reponse, Response::HTTP_OK);
    }

    public function getById(Request $request)
    {   
        $productRepository = new ProductRepository();
        $reponse = $productRepository->getById($request->id);
        return response()->json(new ProductResource($reponse),Response::HTTP_OK);
    }

    public function storage(Request $request)
    {
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
