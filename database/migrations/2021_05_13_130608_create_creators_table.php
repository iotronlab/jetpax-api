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
            $table->string('alt_contact', 15)->nullable();
            $table->string('display_image')->nullable();
            $table->string('cover_image')->nullable();
            //   $table->json('socials')->nullable();
            $table->json('languages')->nullable();
            $table->json('categories')->nullable();
            $table->unsignedBigInteger('max_followers')->nullable();
            $table->text('short_bio', 220)->nullable();
            $table->text('long_bio', 600)->nullable();
            $table->string('refer_code', 50)->nullable();
            $table->string('referral', 50)->nullable();
            $table->boolean('status')->default(false);
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
