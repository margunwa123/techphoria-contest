<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultantRatingsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('consultant_ratings', function (Blueprint $table) {
      $table->id();
      $table->foreignId('consultant_id');
      $table->foreignId('completed_project_id');
      $table->unsignedInteger('rating');
      $table->text('review');
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
    Schema::dropIfExists('consultant_ratings');
  }
}
