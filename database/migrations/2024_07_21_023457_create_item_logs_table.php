<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemLogsTable extends Migration
{
    public function up()
    {
        Schema::create('item_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->string('action', 50);
            $table->integer('quantity');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('action_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('item_logs');
    }
}
