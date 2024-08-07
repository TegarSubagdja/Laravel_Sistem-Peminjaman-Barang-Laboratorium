<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
  public function up()
  {
    Schema::create('items', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->text('description');
      $table->string('picture')->nullable();
      $table->unsignedBigInteger('code')->unique();
      $table->foreignId('lab_id')->constrained('labs')->onDelete('cascade');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('items');
  }
}
