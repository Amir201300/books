<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('jop')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('admin')->insert(
            array(
                'name' => 'Admin',
                'password' => '$2y$10$EFwrcLetY5thqWom2bhYBuCox2ZmjhWvtf8/FtpGns6jJawTFoMDG',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
