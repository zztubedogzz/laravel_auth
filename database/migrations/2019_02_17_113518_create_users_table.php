<?php

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
            $table->increments('id');
            $table->string('name');
            $table->string('password');
            $table->string('roles');
            $table->timestamp('last_login');
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });
        DB::table('users')->insert(array(
            'name'=> 'Admin',
            'password'=> 'admin',
            'roles'=> '*'
        ));
        DB::table('users')->insert(array(
            'name'=> 'User1',
            'password'=> 'User1',
            'roles'=> 'tartalom,user'
        ));
        DB::table('users')->insert(array(
            'name'=> 'User2',
            'password'=> 'User2',
            'roles'=> 'tartalom'
        ));
        DB::table('users')->insert(array(
            'name'=> 'User3',
            'password'=> 'User3',
            'roles'=> 'user'
        ));
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
