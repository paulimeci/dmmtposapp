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
        Schema::create('cmimi_shitjes_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->double('cmimi_vjeter');
            $table->double('cmimi_ri');
            $table->double('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cmimi_shitjes_logs');
    }
};
