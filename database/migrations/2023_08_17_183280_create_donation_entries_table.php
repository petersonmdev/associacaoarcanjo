<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_entries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donation_item_id')->nullable();
            $table->unsignedBigInteger('donor_id');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('donor_id')->references('id')->on('donors')->onDelete('cascade');
            $table->unique('donor_id');
            $table->foreign('donation_item_id')->references('id')->on('donation_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donation_entries');
    }
}
