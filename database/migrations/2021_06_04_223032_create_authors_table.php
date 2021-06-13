<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nameAr')->nullable();
            $table->string('nameEn')->nullable();
            $table->string('image',50)->nullable();
            $table->string('birth_date',50)->nullable();
            $table->string('death_date',50)->nullable();
            $table->longText('aboutAuthorEn')->nullable();
            $table->longText('aboutAuthorAr')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authors');
    }
}
