<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->string('slug', 100);
            $table->timestamps();
        });

        Schema::table('donation_item_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('donation_category_id');
            $table->foreign('donation_category_id')->references('id')->on('donation_item_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('donation_item_categories', function (Blueprint $table) {
            $table->dropForeign('donation_item_categories_donation_category_id_foreign');
            $table->dropColumn('donation_category_id');
        });

        Schema::dropIfExists('donation_categories');
    }
}
