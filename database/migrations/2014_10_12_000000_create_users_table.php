<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->nullable()->unique();
            $table->string('gender',50)->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable()->unique();
            $table->string('country_code')->nullable();
            $table->string('device_type',10)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamp('account_verified')->nullable();
            $table->timestamp('account_blocked')->nullable();
            $table->string('password')->default(bcrypt('password'));
            $table->longText('fcm_id')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('language',30)->default('en');
            $table->string('provider_type')->nullable();
            $table->date('dob')->nullable();
            $table->string('reference_code')->nullable();
            $table->string('reference_type',20)->nullable();
            $table->unsignedBigInteger('reference_by')->nullable();
            $table->unsignedInteger('step')->default(1);
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

         Schema::create('role_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('user_id');
        });

         Schema::table('role_user', function($table) {
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('user_id')->references('id')->on('users');
        });

         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('role_user');
         
    }
}
