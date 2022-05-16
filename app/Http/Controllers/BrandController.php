<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Repository\BrandRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    
    public function index(Request $request)
    {
        $brandRepository = new BrandRepository();
        $response = $brandRepository->brandIndex($request->paginate);
        return response()->json($response, Response::HTTP_OK);
    }

    public function getById(Request $request)
    {
        $brandRepository = new BrandRepository();
        $response = $brandRepository->getById($request->id);
        return response()->json(new BrandResource($response),Response::HTTP_OK);
    }

    public function storage(Request $request)
    {
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
