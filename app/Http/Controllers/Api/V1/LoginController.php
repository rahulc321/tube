<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator,Hash,Mail,DB,DateTime,DateTimeZone,Redirect,Response,File,Image;
use Laravel\Passport\Token;
use App\Helpers\Helper;
use Laravel\Socialite\Facades\Socialite;
class LoginController extends Controller
{
     private function validationCheck($request){
            $rules = [
                'provider_type' => 'required',
                'provider_verification' => 'required',
                'device_type' => 'required|in:ios,android'
            ];
            $customMessages = [
                    'provider_type.required' => 'provider type required facebook,google,email,phone.',
                    'provider_verification.required' => 'provider verification required e.g facebook token, google token,apple token,email otp,phone code(otp)',
                ];
            if($request['provider_type']=='phone'){
                $rules['country_code'] = 'required';
                $rules['provider_id'] = 'required';
                $customMessages['provider_id.required'] = 'provider id required phone number';
            }
            return Validator::make($request->all(), $rules, $customMessages);
    }

    private function validationCheckStep2($request,$table){
            $user = auth()->user();
            $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'dob' => 'required|date|date_format:Y-m-d|before:today',
                'password' => 'required',
                'face_id' => 'required',
                // 'email'=>"nullable|email|unique:$table,email,".$user->id,
            ];
            $customMessages = ['email.unique' => 'Email already exist'];
            return Validator::make($request->all(), $rules, $customMessages);
    }


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
        *               required={"provider_type", "provider_verification","device_type"},
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
    
    public function socialLogin(Request $request) {
        try{

            $validator = $this->validationCheck($request);
            if ($validator->fails()) {
                return response(array(
                    'status' => "error", 
                    'statuscode' => 400, 
                    'message' => $validator->getMessageBag()->first()
                ), 400);
            }

            if(isset($request->country_code)){
                $exist = Str::startsWith($request->country_code, '+');
                if(!$exist){
                    $request->merge(['country_code' =>'+'.$request->country_code]);
                }
            }
            $input = $request->all();
            $driver = $user = null;
            switch ($request['provider_type']) {
                 case 'apple':
                    $response = Helper::appleVerify($input);
                    $device_type = 'IOS';
                    if($response['status']=='error'){
                        return response($response,$response['statuscode']);
                    }
                    $user = $response['user'];
                  break;
                // Facebook
                case 'facebook':
                    $config = [
                      'client_id' => env('FB_CLIENT_ID'),
                      'client_secret' =>env('FB_CLIENT_SECRET'), 
                      'redirect' =>env('FB_REDIRECT_URL'), 
                  ];
                  $driver = Socialite::buildProvider(
                      \Laravel\Socialite\Two\FacebookProvider::class, 
                      $config
                    );
                    break;
                case 'instagram':
                    $config = [
                          'client_id' => env('INSTAGRAM_CLIENT_ID'),
                          'client_secret' =>env('INSTAGRAM_CLIENT_SECRET'), 
                          'redirect' =>env('INSTAGRAM_REDIRECT_URI'), 
                      ];
                    $driver new InstagramAuth($config);
                    break;
                case 'twitter':
                    $config = [
                      'client_id' => env('TWITTER_CLIENT_ID'),
                      'client_secret' =>env('TWITTER_CLIENT_SECRET'), 
                      'redirect' =>env('TWITTER_REDIRECT_URI'), 
                  ];
                  $driver = Socialite::buildProvider(
                      \Laravel\Socialite\Two\TwitterProvider::class, 
                      $config
                    );
                    break;
                case 'google':
                    $driver = \Google::getClient();
                    break;
                // phone - verify code and get login
                case 'phone':
                    $response = Helper::phoneVerify($input);
                    if($response['status']=='error'){
                        return response($response,$response['statuscode']);
                    }
                    $user = $response['user'];
                    break;
            }
            if ($driver) {
                $provider_id = null;
                $email = null;
                $name = null;
                if($request['provider_type']=='google'){
                    $driver_user = Curl::to('https://oauth2.googleapis.com/tokeninfo')
                    ->withData( array( 'id_token' =>$request->provider_verification ) )
                    ->asJson()
                    ->get();
                    if($driver_user){
                       $input['provider_verification'] = $provider_id = $driver_user->sub; 
                       $input['email'] = null; 
                       $input['first_name'] = $name = $driver_user->name; 
                    }
                }else if($request['provider_type']=='instagram'){
                    $driver_user = $instagram->getUserProfileInfo($request->provider_verification);
                    if(!empty($driver_user)){
                        $input['email'] = null;
                        $input['provider_verification'] = $provider_id = $driver_user['id']; 
                        $input['first_name'] = $name = $driver_user['full_name']; 
                    }
                }else{
                    $driver_user = $driver->userFromToken($request->provider_verification);
                    $input['provider_verification'] = $provider_id = $driver_user->getId();
                    $input['email'] = null;
                    $input['first_name'] = $name = $driver_user->getName();
                    $image = $driver_user->getAvatar();
                }
                if (!$driver_user && !$provider_id) {
                    return response(array('status' => "error", 'statuscode' => 400, 'message' => __('Unauthorised')), 400);
                }
                $response = Helper::gmailOrFbVerify($input);
                if($response['status']=='error'){
                    return response($response,$response['statuscode']);
                }
                $user = $response['user'];
                
            }
            $roles = ['user'];
            $user = $user->addUserRequiredDetail($user,$roles);
            if($user){
                $updateduser = User::with('roles')->find($user->id);
                $updateduser->device_type = $input['device_type'];
                $updateduser->provider_type = $input['provider_type'];
                $updateduser->fcm_id = null;
                if(isset($input['fcm_id'])){
                    $updateduser->fcm_id = $input['fcm_id'];
                }
                $updateduser->save();
                $login_data = ['login'=>true];
                $updateduser = User::getUserDetailLogin($user->id,$login_data);
                return response([
                    'status' => "success",
                    'statuscode' => 200,
                    'message' => __('login successfully !'),
                    'data' =>$updateduser
                ], 200);
            }else{
                return response(array('status' => "error", 'statuscode' => 400, 'message' =>"Something went wrong please try again"), 400);
            }
        }catch(Exception $ex){
            return response(['status' => "error", 'statuscode' => 500, 'message' => $ex->getMessage().' '.$ex->getLine()], 500);
        }
    }

    /**
        * @OA\Post(
        * path="/api/v1/user/profile-step-2",
        * operationId="UserStep2",
        * tags={"Register&Login User"},
        * summary="Agent Register,Login",
        * description="Agent Register,Login",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"first_name","last_name","password","dob","gender","face_id"},
        *               @OA\Property(property="first_name", type="text"),
        *               @OA\Property(property="last_name", type="text"),
        *               @OA\Property(property="password", type="text"),
        *               @OA\Property(property="dob", type="text"),
        *               @OA\Property(property="gender",type="text",description="gender string"),
        *               @OA\Property(property="face_id", type="text")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=201,
        *          description="Profile Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=200,
        *          description="Profile Successfully",
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
    public function Step2User(Request $request){
        $user = auth()->user();
        $header = $request->header('Authorization');
        $login_data = ['login'=>false,'header'=>$header];
        $validator = $this->validationCheckStep2($request,$user->getTable());
        if ($validator->fails()) {
            return response(array(
                'status' => "error", 
                'statuscode' => 400, 
                'message' => $validator->getMessageBag()->first()
            ), 400);
        }
        $input = $request->all();
        $data = [
            'first_name'=>$input['first_name'],
            'last_name'=>$input['last_name'],
            'gender'=>$input['gender'],
            'dob'=>$input['dob'],
            'face_id'=>$input['face_id'],
            'password'=>bcrypt($input['password']),
            'step'=>2
        ];
        if(isset($input['profile_image'])){
            $data['profile_image'] = $input['profile_image'];
        }
        User::where('id',$user->id)->update($data);
        $updateduser = User::getUserDetailLogin($user->id,$login_data);
        return response([
            'status' => "success",
            'statuscode' => 200,
            'message' => __('Profile updated'),
            'data' =>$updateduser
        ], 200);
    }
}
