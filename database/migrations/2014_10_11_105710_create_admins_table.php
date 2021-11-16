<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('superadmin_id')->unsigned()->nullable();
            $table->foreign('superadmin_id')->references('id')->on('superadmins')->onDelete('cascade');   
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('phone')->unique();
            $table->string('customerprefix',10)->unique();
            $table->string('email')->unique();
             $table->string('password');
             $table->string('company')->nullable();
             $table->string('address')->nullable();
             $table->string('package')->nullable();
            $table->string('web')->nullable();
            $table->integer('otp');
           $table->string('country')->nullable();
             $table->tinyInteger('status')->default(2);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropIfExists('admins');
    }
}
