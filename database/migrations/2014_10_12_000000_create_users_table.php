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
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->unsignedBiginteger('verifiedBy')->nullable();
            $table->foreign('verifiedBy')->references('id')->on('users');
            $table->string('password');
            $table->string('secondaryPhone')->nullable();
            $table->string('addressLine')->nullable();
            $table->string('city')->nullable();
            $table->string('taluka')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();
            $table->boolean('isBanned')->default(0);
            $table->string('aadharNumber')->nullable();
            $table->string('isWhatsapp')->nullable();
            $table->string('sendEmail')->default(1);
            $table->string('sendSms')->default(1);
            $table->string('bloodGroup')->nullable();
            $table->boolean('canDonate')->default('1');
            $table->integer('ipAddress')->unsigned()->nullable();
            $table->dateTime('last_seen')->nullable();
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
