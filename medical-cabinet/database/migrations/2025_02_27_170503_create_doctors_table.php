<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('speciality');
            $table->string('phone');
            $table->text('description')->nullable();
            $table->string('photo')->nullable(); // Lien de l'image
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}