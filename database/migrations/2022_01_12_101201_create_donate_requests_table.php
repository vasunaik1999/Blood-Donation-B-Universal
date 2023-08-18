<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donate_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('no_of_packs');
            $table->unsignedBiginteger('request_id')->nullable();
            $table->foreign('request_id')->references('id')->on('request_helps');
            $table->string('status')->default(1); //0 -> rej 1->standby 2->completed
            $table->unsignedBiginteger('help_by')->nullable();
            $table->foreign('help_by')->references('id')->on('users');
            $table->string('remark')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('in_form_of')->nullable();
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
        Schema::dropIfExists('donate_requests');
    }
}
