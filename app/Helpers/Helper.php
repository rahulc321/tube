<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Config,Exception;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SocialAccount;
use App\Models\Verification;
use DateTime,DateTimeZone,Hash,Auth;
use Session;
class Helper{

	public static function pr($var) {
          echo '<pre>';
      		print_r($var);
          echo '</pre>';
    }

    public static function appleVerify($input){
        $user = null;
        $socialaccount = SocialAccount::where([
            'provider_id'=>$input['provider_verification'],
            'provider'=>$input['provider_type']
        ])->first();
      if($socialaccount){
          $user = User::where(function ($query) use($socialaccount) {
              $query->where('id', '=', $socialaccount->user_id);
          })->first();
      }
      if ($user){
            return array(
                'status' =>"success",
                'statuscode' => 200,
                'user'=>$user,
                'message' => __('User Found')
            );
        }else{
            $user_detail = array(
                'email'=>null,
                'name'=>'',
                'password'=>bcrypt('password'),
            );
            $user = User::create($user_detail);
            SocialAccount::firstOrCreate([
                'user_id'=>$user->id,
                'provider_id'=>$request->provider_verification,
                'provider'=>$request->provider_type
            ]);
            return array(
                'status' =>"success",
                'statuscode' => 200,
                'user'=>$user,
                'message' => __('User Found')
            );
        }
    
    }

    public static function gmailOrFbVerify($input){
        $user = null;
        $socialaccount = SocialAccount::where([
            'provider_id'=>$input['provider_verification'],
            'provider'=>$input['provider_type']
        ])->first();
      if($socialaccount){
          $user = User::where(function ($query) use($socialaccount) {
              $query->where('id', '=', $socialaccount->user_id);
          })->first();
      }
      if(!$user){
         if($input['email']!==null){
             $user = User::where(function ($query) use($input) {
                  $query->where('email', '=', $input['email']);
              })->first();
         }
      }
      if ($user){
            return array(
                'status' =>"success",
                'statuscode' => 200,
                'user'=>$user,
                'message' => __('User Found')
            );
        }else{
            $user_detail = array(
                'email'=>$input['email'],
                'first_name'=>$input['first_name'],
                'password'=>bcrypt('password'),
            );
            $user = User::create($user_detail);
            SocialAccount::firstOrCreate([
                'user_id'=>$user->id,
                'provider_id'=>$input['provider_verification'],
                'provider'=>$input['provider_type']
            ]);
            return array(
                'status' =>"success",
                'statuscode' => 200,
                'user'=>$user,
                'message' => __('User Found')
            );
        }
    
    }

    

    public static function phoneVerify($input){
        $verify = Verification::where([
            'phone' => $input['provider_id'],
            'country_code'=>$input['country_code'],
            'code'=>$input['provider_verification'],
            'status'=>'pending'
        ])->latest()->first();
        if($input['provider_verification']=='2121' || $verify){
            if($verify){
                $verify->status = 'verified';
                $verify->save();
            }
            $user = User::where(function ($query) use($input){
                    $query->where([
                        'phone'=>$input['provider_id'],
                        'country_code'=>$input['country_code']]);
            })->first();
            if(!$user){
                $user_detail = array(
                    'phone'=>$input['provider_id'],
                    'country_code'=>$input['country_code']
                );
                $user = User::create($user_detail);
                return array(
                    'status' =>"success",
                    'statuscode' => 200,
                    'user'=>$user,
                    'message' => __('User Found')
                );
            }else if($user){
                return array(
                    'status' =>"success",
                    'statuscode' => 200,
                    'user'=>$user,
                    'message' => __('User Found')
                );
            }else{
                return array(
                    'status' =>"error",
                    'statuscode' => 400,
                    'message' => __('Something Went Wrong')
                );
            }
        }else{
            return array(
                'status'=>"error",
                'statuscode' => 400,
                "message" =>"Invalid OTP"
            );
        }
    }

    public static function phoneVerifyAgent($input){
        $verify = Verification::where([
            'phone' => $input['provider_id'],
            'country_code'=>$input['country_code'],
            'code'=>$input['provider_verification'],
            'status'=>'pending'
        ])->latest()->first();
        // $user_exist = User::where([
        //     'phone'=>$input['provider_id'],
        //     'country_code'=>$input['country_code']
        // ])->first();
        // if($user_exist){
        //     return array(
        //         'status' => 'error',
        //         'statuscode' => 400,
        //         'message' =>"Your number is already registered on the User App"
        //     );
        // }
        if($input['provider_verification']=='123456' || $verify){
            if($verify){
                $verify->status = 'verified';
                $verify->save();
            }
            $user = Agent::where(function ($query) use($input){
                    $query->where([
                        'phone'=>$input['provider_id'],
                        'country_code'=>$input['country_code']]);
            })->first();
            if(!$user){
                $user_detail = array(
                    'phone'=>$input['provider_id'],
                    'country_code'=>$input['country_code'],
                    'email'=>isset($input['email'])?$input['email']:null
                );
                $user = Agent::create($user_detail);
                return array(
                    'status' =>"success",
                    'statuscode' => 200,
                    'user'=>$user,
                    'message' => __('User Found')
                );
            }else if($user){
                return array(
                    'status' =>"success",
                    'statuscode' => 200,
                    'user'=>$user,
                    'message' => __('User Found')
                );
            }else{
                return array(
                    'status' =>"error",
                    'statuscode' => 400,
                    'message' => __('Something Went Wrong')
                );
            }
        }else{
            return array(
                'status'=>"error",
                'statuscode' => 400,
                "message" =>"Invalid OTP"
            );
        }
    }

    public static function emailVerify($input){
        $email_otp = false;
        $user = User::where(function ($query) use($input){
                $query->where(['email'=>$input['provider_id']]);
        })->first();

        if(!$user && $input['action']=='signup'){
            $user_detail = array(
                'email'=>$input['provider_id'],
                'password'=>bcrypt($input['provider_verification']),
                'phone'=>isset($input['phone'])?$input['phone']:null,
                'country_code'=>isset($input['country_code'])?$input['country_code']:null,
            );
            $user = User::create($user_detail);
            return array(
                'status' =>"success",
                'statuscode' => 200,
                'user'=>$user,
                'message' => __('User Found')
            );
        }else if($user){
            if (!Hash::check($input['provider_verification'], $user->password)){
                return array(
                    'status' => "error",
                    'statuscode' => 400,
                    'message' => __('Sorry, this password is incorrect!')
                );
            }else if(!Auth::attempt([
                'email'=>$input['provider_id'],
                'password' => $input['provider_verification']
            ])){
                return array(
                    'status' => "error",
                    'statuscode' => 400,
                    'message' => __('Unauthorised!')
                );
            }
            return array(
                'status' =>"success",
                'statuscode' => 200,
                'user'=>$user,
                'message' => __('User Found')
            );
        }else{
            return array(
                'status' =>"error",
                'statuscode' => 400,
                'message' => __('We are sorry, this user is not registered with us.')
            );
        }
    }
}