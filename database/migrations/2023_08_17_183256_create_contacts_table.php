<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number_whatsapp', 100);
            $table->string('phone_number1', 100)->nullable();
            $table->string('phone_number2', 100)->nullable();
            $table->timestamps();
        });

        Schema::table('donors', function (Blueprint $table) {
          $table->unsignedBigInteger('contact_id')->nullable();
          $table->foreign('contact_id')->references('id')->on('donors');
        });

        Schema::table('voluntaries', function (Blueprint $table) {
          $table->unsignedBigInteger('contact_id')->nullable();
          $table->foreign('contact_id')->references('id')->on('voluntaries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('donors', function (Blueprint $table) {
          $table->dropForeign('donor_contact_id_foreign');
          $table->dropColumn('contacts_id');
        });

        Schema::table('voluntaries', function (Blueprint $table) {
          $table->dropForeign('voluntary_contact_id_foreign');
          $table->dropColumn('voluntary_id');
        });

        Schema::dropIfExists('contacts');
    }
}
