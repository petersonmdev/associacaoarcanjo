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
            $table->integer('reserved');
            $table->integer('delivered');
            $table->string('status', 100);
            $table->timestamps();
        });

        Schema::table('donation_outputs', function (Blueprint $table) {
            $table->unsignedBigInteger('donation_movement_id');
            $table->foreign('donation_movement_id')->references('id')->on('donation_outputs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('donation_outputs', function (Blueprint $table) {
            $table->dropForeign('donation_outputs_donation_movement_id_foreign');
            $table->dropColumn('donation_movement_id');
        });

        Schema::dropIfExists('donation_movements');
    }
}
