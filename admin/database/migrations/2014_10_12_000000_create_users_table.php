<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken()->nullable();
            $table->string('company')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('postcode')->nullable();
            $table->timestamps();			
        });

        // DB::table('users')->insert([
        //     [
        //         'first_name' => 'admin',
        //         'last_name' => 'mail',
        //         'username' => 'admin',
        //         'email' => 'admin@mail.com',
        //         'email_verified_at' => NOW(),
        //         'username' => 'admin',
        //         'password' => Hash::make('admin'),
        //         'created_at' => NOW()
        //     ],
        //     [
        //         'first_name' => 'user',
        //         'last_name' => 'mail',
        //         'username' => 'user',
        //         'email' => 'user@mail.com',
        //         'email_verified_at' => NOW(),
        //         'username' => 'user',
        //         'password' => Hash::make('user'),
        //         'created_at' => NOW()
        //     ]
        // ]);
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
