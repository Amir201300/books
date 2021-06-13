<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRateNewToBook extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->tinyInteger('rate')->nullable();
            $table->integer('download')->nullable();
            $table->integer('view')->nullable();
            $table->tinyInteger('isNew')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('linkType')->nullable();  // 2=>in server , 1=>out of server
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            //
        });
    }
}
