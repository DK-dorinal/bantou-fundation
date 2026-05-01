<?php
// database/migrations/2026_05_01_000001_create_passwordless_tokens_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('passwordless_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('email')->index();
            $table->string('token', 255); // Token haché
            $table->string('code', 6); // Code original (si besoin de débogage, à supprimer en prod)
            $table->timestamp('expires_at');
            $table->boolean('is_used')->default(false);
            $table->integer('attempts')->default(0);
            $table->timestamps();

            $table->index(['email', 'expires_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('passwordless_tokens');
    }
};
