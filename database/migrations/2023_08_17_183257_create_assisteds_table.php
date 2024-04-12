<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssistedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assisteds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contact_id');
            $table->unsignedBigInteger('address_id');
            $table->string('name', 100);
            $table->string('email', 100)->nullable();
            $table->string('taxvat')->nullable()->unique();
            $table->date('dob')->nullable();
            $table->string('civil_status', 100)->nullable();
            $table->string('education_level', 100)->nullable();
            $table->string('profession', 100)->nullable();
            $table->boolean('jobless')->default(false)->nullable();
            $table->boolean('active')->default(true);
            $table->longText('life_history')->nullable();
            $table->longText('health_history')->nullable();
            $table->longText('continuous_medication')->nullable();
            $table->timestamps();

            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->foreign('address_id')->references('id')->on('addresses');
        });

        Schema::table('donation_outputs', function (Blueprint $table) {
            $table->unsignedBigInteger('assisted_id');
            $table->foreign('assisted_id')->references('id')->on('donation_outputs');
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
            $table->dropForeign('donation_outputs_assisted_id_foreign');
            $table->dropColumn('assisted_id');
        });

        Schema::dropIfExists('assisteds');
    }
}
