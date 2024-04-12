<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoluntariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voluntaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('address_id');
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('taxvat')->nullable();
            $table->date('dob')->nullable();
            $table->string('driving', 100)->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->unique('user_id');
        });

        Schema::table('assisteds', function (Blueprint $table) {
            $table->unsignedBigInteger('voluntary_id');
            $table->foreign('voluntary_id')->references('id')->on('voluntaries');
        });

        Schema::table('donation_movements', function (Blueprint $table) {
            $table->unsignedBigInteger('voluntary_id');
            $table->foreign('voluntary_id')->references('id')->on('donation_movements');
        });

        Schema::table('donation_outputs', function (Blueprint $table) {
            $table->unsignedBigInteger('voluntary_id');
            $table->foreign('voluntary_id')->references('id')->on('donation_outputs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assisteds', function (Blueprint $table) {
            $table->dropForeign('assisteds_voluntary_id_foreign');
            $table->dropColumn('voluntary_id');
        });

        Schema::table('donation_movements', function (Blueprint $table) {
            $table->dropForeign('donation_movements_voluntary_id_foreign');
            $table->dropColumn('voluntary_id');
        });

        Schema::table('donation_outputs', function (Blueprint $table) {
            $table->dropForeign('donation_outputs_voluntary_id_foreign');
            $table->dropColumn('voluntary_id');
        });

        Schema::dropIfExists('voluntaries');
    }
}
