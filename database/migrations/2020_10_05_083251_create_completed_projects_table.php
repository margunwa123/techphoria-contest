<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompletedProjectsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('completed_projects', function (Blueprint $table) {
      $table->id();
      $table->foreignId("consultant_id");
      $table->foreignId("company_id");
      $table->foreign("client_id")->references('id')->on('user');
      $table->string("finance_type");
      $table->unsignedBigInteger("fee");
      $table->text("description");
      $table->text("review");
      $table->unsignedInteger("rating")->min(0)->max(5);
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
    Schema::dropIfExists('completed_projects');
  }
}
