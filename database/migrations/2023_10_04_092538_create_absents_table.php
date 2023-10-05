<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absents', function (Blueprint $table) {
            $table->id();
            $table->string("user_id")->nullable(false);
            $table->string("img")->nullable(false);
            $table->string("location")->nullable(false);
            $table->time("datang")->nullable(true);
            $table->time("pulang")->nullable(true)->default(null);
            $table->date("tanggal")->nullable(false);
            $table->foreign("user_id")->on("users")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absents');
    }
};
