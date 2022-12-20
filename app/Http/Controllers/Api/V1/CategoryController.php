<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
        * @OA\Post(
        * path="/api/v1/user/login",
        * operationId="UserLogin",
        * tags={"Register&Login User"},
        * summary="User Register,Login",
        *   security={ {"Bearer": {} }},
        * description="User Register,Login",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"provider_type","provider_id", "country_code", "provider_verification","device_type"},
        *               @OA\Property(property="provider_type", type="text"),
        *               @OA\Property(property="provider_id", type="text"),
        *               @OA\Property(property="country_code", type="text"),
        *               @OA\Property(property="device_type", type="text"),
        *               @OA\Property(property="provider_verification", type="text"),
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=201,
        *          description="Login Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=200,
        *          description="Login Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    
    public function getCategory(Request $request) {
        try{

             
            
                $category = Category::get();
                return response([
                    'status' => "success",
                    'statuscode' => 200,
                    'message' => __('List Category !'),
                    'data' =>['category'=>$category]
                ], 200);
             
        }catch(Exception $ex){
            return response(['status' => "error", 'statuscode' => 500, 'message' => $ex->getMessage().' '.$ex->getLine()], 500);
        }
    }

}
