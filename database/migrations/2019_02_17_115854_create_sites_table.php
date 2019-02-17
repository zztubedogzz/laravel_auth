<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('link');
            $table->string('roles');
            $table->timestamps();
        });
        DB::table('sites')->insert(array(
            'name'=> 'Admin',
            'description'=> 'Adminisztrációs oldal',
            'link'=> 'admin',
            'roles'=> '*'
        ));
        DB::table('sites')->insert(array(
            'name'=> 'Tartalomszerkesztő',
            'description'=> 'Tartalomszerkesztők számára fentartott oldal',
            'link'=> 'content-management',
            'roles'=> 'tartalom'
        ));
        DB::table('sites')->insert(array(
            'name'=> 'Felhasználó',
            'description'=> 'Bejelentkezett felhasználók oldala',
            'link'=> 'user',
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
        Schema::dropIfExists('sites');
    }
}
