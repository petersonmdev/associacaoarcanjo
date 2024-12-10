<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donation_item_id')->nullable();
            $table->unsignedBigInteger('voluntary_id')->nullable();
            $table->integer('reserved');
            $table->integer('delivered');
            $table->string('status', 100);
            $table->timestamps();

            $table->foreign('donation_item_id')->references('id')->on('donation_items')->onDelete('cascade');
            $table->foreign('voluntary_id')->references('id')->on('voluntaries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donation_movements');
    }
}
