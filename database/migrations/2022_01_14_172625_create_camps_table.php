<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBiginteger('organized_by')->nullable();
            $table->foreign('organized_by')->references('id')->on('users');
            $table->string('collobration_with')->nullable();
            $table->string('phone')->nullable();
            $table->string('secondaryPhone')->nullable();
            $table->string('location')->nullable();
            $table->string('address')->nullable();
            $table->dateTime('from_date')->nullable();
            $table->dateTime('to_date')->nullable();
            $table->string('no_of_days')->nullable();
            $table->string('poster')->nullable();
            $table->dateTime('last_registration_date')->nullable();
            $table->string('registration_id')->nullable();
            $table->longText('description')->nullable();
            $table->json('parthners')->nullable();
            $table->integer('people_registered')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('camps');
    }
}
