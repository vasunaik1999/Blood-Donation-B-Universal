<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestHelpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_helps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('createdBy')->nullable();
            $table->foreign('createdBy')->references('id')->on('users');
            $table->string('name');
            $table->string('phone');
            $table->boolean('isWhatsapp')->default(0);
            $table->string('patient_name')->nullable();
            $table->string('required_for')->nullable();
            $table->string('required_blood_group');
            $table->integer('blood_quantity');
            $table->string('hospital')->nullable();
            // $table->string('taluka')->nullable();
            $table->dateTime('required_before')->nullable();
            $table->string('otp')->nullable();
            $table->string('status')->default('0');
            $table->integer('completed')->default('0');
            $table->integer('approach_count')->default('0');
            $table->integer('approach_packs_count')->default('0');
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
        Schema::dropIfExists('request_helps');
    }
}
