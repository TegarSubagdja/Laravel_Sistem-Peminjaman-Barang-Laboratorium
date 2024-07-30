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
      $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
      $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
      $table->dateTime('loan_date');
      $table->dateTime('return_date')->nullable();
      $table->enum('status', ['waiting', 'approved', 'rejected'])->default('waiting');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('loans');
  }
}
