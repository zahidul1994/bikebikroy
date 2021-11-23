<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikebrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bikebrands', function (Blueprint $table) {
           $table->string('bikebrand')->unique();
            $table->string('slug')->unique();
            $table->string('bnbikebrand')->unique();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('bikbrands');
    }
}
