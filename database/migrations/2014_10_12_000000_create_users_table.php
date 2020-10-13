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
            $table->string('name')->nullable();
            $table->enum('age', ['small', 'medium', 'large', 'extra'])->default('medium');
            $table->string('gender')->nullable();
            $table->enum('hascorona', ['oui', 'non'])->default('non');
            $table->text('mixers')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
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
        Schema::dropIfExists('users');
    }
}
