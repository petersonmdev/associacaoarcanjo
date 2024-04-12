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
            $table->unsignedBigInteger('donor_id');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('donor_id')->references('id')->on('donors');
            $table->unique('donor_id');
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
