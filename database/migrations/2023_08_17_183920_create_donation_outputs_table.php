<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationOutputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_outputs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assisted_id')->nullable();
            $table->unsignedBigInteger('voluntary_id')->nullable();
            $table->unsignedBigInteger('donation_movement_id')->nullable();
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('assisted_id')->references('id')->on('assisteds')->onDelete('cascade');
            $table->foreign('voluntary_id')->references('id')->on('voluntaries')->onDelete('cascade');
            $table->foreign('donation_movement_id')->references('id')->on('donation_movements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donation_outputs');
    }
}
