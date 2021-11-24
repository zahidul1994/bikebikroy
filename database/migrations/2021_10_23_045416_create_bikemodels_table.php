<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikemodelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bikemodels', function (Blueprint $table) {
            $table->string('bikemodel')->unique();
            $table->bigInteger('bikebrand_id')->unsigned()->nullable();
            $table->foreign('bikebrand_id')->references('_id')->on('bikebrands')->onDelete('cascade');
            $table->string('slug')->unique();
            $table->string('bnbikemodel')->unique();
            $table->string('bikemodelimage')->nullable();
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
        Schema::dropIfExists('bikmodels');
    }
}
