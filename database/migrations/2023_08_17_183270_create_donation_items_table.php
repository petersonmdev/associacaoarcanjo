<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->integer('quantity');
            $table->float('weight', 8, 3)->nullable();
            $table->string('brand', 100)->nullable();
            $table->integer('size')->nullable();
            $table->date('expiration_date');
            $table->timestamps();
        });

        Schema::table('donation_movements', function (Blueprint $table) {
            $table->unsignedBigInteger('donation_item_id');
            $table->foreign('donation_item_id')->references('id')->on('donation_movements');
        });

        Schema::table('donation_entries', function (Blueprint $table) {
            $table->unsignedBigInteger('donation_item_id');
            $table->foreign('donation_item_id')->references('id')->on('donation_entries');
        });

        Schema::table('donation_item_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('donation_item_id');
            $table->foreign('donation_item_id')->references('id')->on('donation_item_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('donation_movements', function (Blueprint $table) {
            $table->dropForeign('donation_movements_donation_item_id_foreign');
            $table->dropColumn('donation_item_id');
        });

        Schema::table('donation_entries', function (Blueprint $table) {
            $table->dropForeign('donation_entries_donation_item_id_foreign');
            $table->dropColumn('donation_item_id');
        });

        Schema::table('donation_item_categories', function (Blueprint $table) {
            $table->dropForeign('donation_item_categories_donation_item_id_foreign');
            $table->dropColumn('donation_item_id');
        });

        Schema::dropIfExists('donation_items');
    }
}
