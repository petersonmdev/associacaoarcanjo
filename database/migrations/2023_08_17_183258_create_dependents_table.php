<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assisted_id');
            $table->string('name', 100);
            $table->date('dob');
            $table->string('sex', 100)->nullable();
            $table->string('parentage', 100)->nullable();
            $table->string('profession', 100)->nullable();
            $table->boolean('pne')->default(false)->nullable();
            $table->timestamps();

            $table->foreign('assisted_id')->references('id')->on('assisteds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dependents');
    }
}
