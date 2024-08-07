<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
  public function up()
  {
    Schema::create('loans', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('item_id');
      $table->foreign('user_id')->references('nrp')->on('users')->onDelete('cascade');
      $table->foreign('item_id')->references('code')->on('items')->onDelete('cascade');
      $table->dateTime('loan_date');
      $table->dateTime('return_date')->nullable();
      $table->enum('status', ['waiting', 'approved', 'rejected', 'done', 'cancelled'])->default('waiting');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('loans');
  }
}
