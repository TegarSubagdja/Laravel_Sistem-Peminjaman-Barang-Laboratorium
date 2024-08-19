<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordResetTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->index();    // Kolom email dengan index
            $table->string('token');             // Kolom token untuk menyimpan reset token
            $table->timestamp('created_at')->nullable();  // Kolom created_at untuk waktu pembuatan token
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_reset_tokens');  // Hapus tabel jika rollback dilakukan
    }
}
