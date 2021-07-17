<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreatorService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creator_service', function (Blueprint $table) {

            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('creator_id');
            $table->integer('rate');
            $table->string('details')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('creator_id')->references('id')->on('creators')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creator_services');
    }
}
