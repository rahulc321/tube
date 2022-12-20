<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Service;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::firstOrCreate(['name'=>'admin']);
        $customer = Role::firstOrCreate(['name'=>'user']);
        $service_provider = Role::firstOrCreate(['name'=>'doctor']);
        $archived_user = Role::firstOrCreate(['name'=>'archived_user']);

        $user = User::firstOrCreate(['email'=>'admin@admin.com']);
        $user->password = bcrypt('admin@123');
        $user->first_name = 'Admin';
        if($user->save()){
            if(!$user->hasRole('admin')){
                $user->roles()->attach($admin);
            }
        }


         
    }
}
