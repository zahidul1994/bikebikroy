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
            // $table->id();
            $table->unsignedInteger('admin_id')->nullable();
            $table->string('fullname');
            $table->string('username')->nullable();
            $table->string('phone')->nullable();
            $table->string('accounttpe')->nullable();
            $table->string('membertype')->nullable();
            $table->string('salertype')->nullable();
            $table->unsignedInteger('package_id')->nullable();
            $table->string('email')->nullable();
            $table->string('password');
           $table->date('birthdate')->nullable();
          $table->unsignedInteger('division_id')->nullable();
           $table->unsignedInteger('district_id')->nullable();
           $table->unsignedInteger('thana_id')->nullable();
         $table->tinyInteger('shop')->default(0);
         $table->string('shoptitle',350)->nullable();
           $table->string('shopdescripiton',1350)->nullable();
           $table->string('googleloaction',500)->nullable();
           $table->string('saturday')->nullable();
           $table->string('sunday')->nullable();
           $table->string('monday')->nullable();
           $table->string('tuesday')->nullable();
           $table->string('wednesday')->nullable();
           $table->string('thuresday')->nullable();
           $table->string('friday')->nullable();
           $table->string('profilephoto')->nullable();
           $table->string('coverphoto')->nullable();
           $table->date('shopexpirydate')->nullable();
           $table->string('path')->nullable();
           $table->string('otp')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
