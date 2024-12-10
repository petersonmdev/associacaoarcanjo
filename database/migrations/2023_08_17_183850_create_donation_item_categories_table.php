<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationItemCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_item_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donation_item_id')->nullable();
            $table->unsignedBigInteger('donation_category_id')->nullable();
            $table->timestamps();

            $table->foreign('donation_item_id')->references('id')->on('donation_items')->onDelete('cascade');
            $table->foreign('donation_category_id')->references('id')->on('donation_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donation_item_categories');
    }
}
