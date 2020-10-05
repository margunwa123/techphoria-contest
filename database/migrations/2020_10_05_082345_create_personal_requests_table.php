<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_requests', function (Blueprint $table) {
          $table->id();
          $table->foreignId("consultant_id");
          $table->foreignId("company_id");
          $table->string("finance_type");
          $table->text("description");
          $table->unsignedBigInteger('fee');
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
        Schema::dropIfExists('personal_requests');
    }
}
