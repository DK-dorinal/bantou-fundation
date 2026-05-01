<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('passwordless_tokens', function (Blueprint $table) {
            // Rendre la colonne code nullable
            $table->string('code', 6)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('passwordless_tokens', function (Blueprint $table) {
            $table->string('code', 6)->nullable(false)->change();
        });
    }
};
