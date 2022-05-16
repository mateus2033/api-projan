<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Repository\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    
    public function Index(Request $request)
    {
        $categoryRepository = new CategoryRepository();
        $response = $categoryRepository->CategoryIndex($request->paginate);
        return response()->json($response, Response::HTTP_OK);
    }

    public function getById(Request $request)
    {
        $categoryRepository = new CategoryRepository();
        $response = $categoryRepository->getById($request->id);
        return response()->json(new CategoryResource($response),Response::HTTP_OK);
    }

    public function storage(Request $request)
    {
        $categoryRepository = new CategoryRepository();
        $reponse = $categoryRepository->storageCategory($request);
        
        if(!isset($reponse['code'])){
            DB::commit();
            return response()->json(new CategoryResource($reponse),Response::HTTP_OK);
        } else {
            DB::rollBack();
            return response()->json($reponse, Response::HTTP_BAD_REQUEST);
        }
    }
}
