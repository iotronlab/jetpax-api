<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creators', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->enum('gender', ['M', 'F', 'Universal']);
            $table->string('contact', 15);
            $table->string('display_image', 255)->nullable();
            $table->string('cover_image', 255)->nullable();
            $table->json('socials')->nullable();
            $table->json('languages')->nullable();
            $table->json('categories')->nullable();
            $table->unsignedBigInteger('max_followers')->nullable();
            $table->text('details', 255)->nullable();

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
        Schema::dropIfExists('creators');
    }
}
