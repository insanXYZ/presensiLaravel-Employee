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
            $table->string("id")->nullable(false)->primary();
            $table->string("user_id")->nullable(false);
            $table->string("in_img")->nullable(false);
            $table->string("out_img")->nullable(true)->default(null);
            $table->string("in_location")->nullable(false);
            $table->string("out_location")->nullable(true)->default(null);
            $table->time("in_time")->nullable(true);
            $table->time("out_time")->nullable(true)->default(null);
            $table->date("date")->nullable(false);
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
