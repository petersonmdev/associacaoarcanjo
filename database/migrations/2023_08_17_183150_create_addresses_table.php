<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('addresses', function (Blueprint $table) {
      $table->id();
      $table->string('zipcode');
      $table->string('address', 150);
      $table->integer('number')->nullable();
      $table->string('complement', 100)->nullable();
      $table->string('neighborhood', 100);
      $table->string('city', 100);
      $table->string('state', 2);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('addresses');
  }
}
