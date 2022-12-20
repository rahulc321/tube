<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\Wallet;
use App\Models\Profile;
class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','first_name','last_name','phone','country_code','device_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
    * @param string|array $roles
    */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
                 abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) ||
             abort(401, 'This action is unauthorized.');
    }
    /**
    * Check multiple roles
    * @param array $roles
    */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }
    /**
    * Check one role
    * @param string $role
    */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    /**
    * User Wallets
    * @param 
    */
    public function wallet()
    {
        return $this->hasOne('App\Models\Wallet','user_id');
    }

    /**
    * User Wallets
    * @param 
    */
    public function profile()
    {
        return $this->hasOne('App\Models\Profile','user_id');
    }

    public function addUserRequiredDetail($user,$roles){
        $roles2 = Role::whereIn('name',$roles)->get();
        if(!isset($user->roles[0])){
            if($roles2){
                $user->roles()->attach($roles2);
            }
        }
        if(!$user->wallet){
            $wallet = new Wallet();
            $wallet->balance = 0;
            $wallet->user_id = $user->id;
            $wallet->points = 0;
            $wallet->save();
        }
        if(!$user->reference_code){
            $random = Str::random(10);
            $user->reference_code = $random.$user->id;
        }
        if(!$user->unique_id){
            $user->unique_id = "NHC0000".$user->id;
        }
        $user->save();
        if(!$user->profile)
            Profile::create(['user_id'=>$user->id,'rating'=>5]);
        return $user;
    }

    public static function getUserDetailLogin($id,$login_data){
        $user = auth()->user();
        if(!$user){
            $user = self::find($id);
        }
        $updateduser = self::select('id','unique_id','email','first_name','last_name','gender','phone','country_code','device_type','fcm_id','profile_image','language','provider_type','step','account_blocked','reference_code','face_id')->find($id);
        if($login_data['login']){
            $userTokens = $user->tokens;
            if($userTokens){
                foreach($userTokens as $token) {
                    $token->revoke();   
                }
            }
            $token = $user->createToken('OHA')->accessToken;
            $updateduser->token = $token;
        }else{
            $header = $login_data['header'];
           if (Str::startsWith($header, 'Bearer ')) {
                $updateduser->token = Str::substr($header, 7);
           }
        }
        $updateduser->signup_completed = false;
        if($updateduser->step==2){
            $updateduser->signup_completed = true;
        }
        $updateduser->rating = $user->profile->rating;
        return $updateduser;
    }
}
